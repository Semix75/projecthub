<?php
namespace App\Controller\Api;

use App\Entity\Message;
use App\Entity\Conversation;
use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use App\Repository\MessageRepository;
use Symfony\Component\HttpFoundation\Response;


class MessageController extends AbstractController
{
    #[Route('/api/messages', name: 'api_send_message', methods: ['POST'])]
    public function sendMessage(
        Request $request,
        EntityManagerInterface $em,
        HubInterface $hub,
        ConversationRepository $conversationRepository
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);
        $user = $this->getUser();

        if (!$user) {
            return new JsonResponse(['error' => 'Unauthorized'], 401);
        }

        $conversation = $conversationRepository->find($data['conversation_id']);

        if (!$conversation) {
            return new JsonResponse(['error' => 'Conversation not found'], 404);
        }

        $message = new Message();
        $message->setContent($data['content']);
        $message->setSendBy($user);
        $message->setConversation($conversation);
        $message->setSendAt(new \DateTime());

        $em->persist($message);
        $em->flush();

        // Mercure : diffuser aux abonnés
        $update = new Update(
            "/conversations/{$conversation->getId()}",
            json_encode([
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'sendBy' => $user->getUsername(),
                'senddAt' => $message->getSendAt()->format('Y-m-d H:i:s')
            ])
        );

        $hub->publish($update);

        return new JsonResponse(['status' => 'Message sent'], 201);
    }




    #[Route('/api/conversations/{id}/messages', name: 'api_get_messages', methods: ['GET'])]
public function getMessages(
    int $id,
    ConversationRepository $conversationRepository,
    MessageRepository $messageRepository
): JsonResponse {
    $conversation = $conversationRepository->find($id);

    if (!$conversation) {
        return new JsonResponse(['error' => 'Conversation not found'], 404);
    }

    $messages = $messageRepository->createQueryBuilder('m')
        ->where('m.conversation = :conversation')
        ->setParameter('conversation', $conversation)
        ->orderBy('m.sendAt', 'ASC')
        ->getQuery()
        ->getResult();

    $messageList = array_map(function ($message) {
        return [
            'id' => $message->getId(),
            'content' => $message->getContent(),
            'sendBy' => $message->getSendBy()->getUsername(),
            'sendAt' => $message->getSendAt()->format('Y-m-d H:i:s'),
        ];
    }, $messages);

    return new JsonResponse($messageList, 200);
}
}


