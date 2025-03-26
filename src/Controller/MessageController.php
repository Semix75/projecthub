<?php

namespace App\Controller;

use App\Entity\Message;
use App\Entity\Conversation;
use App\Repository\ConversationRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Mercure\HubInterface;
use Symfony\Component\Mercure\Update;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication;
use Symfony\Component\Security\Core\Security;
use Symfony\Component\Messenger\MessageBusInterface;



class MessageController extends AbstractController
{
    #[Route('/api/messages', name: 'api_messages_add', methods: ['POST'])]
    public function addMessage(
        Request $request,
        EntityManagerInterface $em,
        MessageBusInterface $bus
    ): JsonResponse {
        $data = json_decode($request->getContent(), true);

        if (!isset($data['content'], $data['conversation'])) {
            return new JsonResponse(['error' => 'Missing fields'], 400);
        }

        $user = $this->getUser();

        $message = new Message();
        $message->setContent($data['content']);
        $message->setSendAt(new \DateTimeImmutable());
        $message->setSendBy($user);
        $message->setConversation($em->getReference(Conversation::class, $data['conversation']));

        $em->persist($message);
        $em->flush();

        // Publie sur Mercure
        $update = new Update(
            sprintf("/conversations/%d", $data['conversation']),
            json_encode([
                'id' => $message->getId(),
                'content' => $message->getContent(),
                'sendBy' => $user->getUserIdentifier(),
                'sendAt' => $message->getSendAt()->format('Y-m-d H:i:s'),
            ])
        );
        $bus->dispatch($update);

        return new JsonResponse(['status' => 'Message created']);
    }

}
