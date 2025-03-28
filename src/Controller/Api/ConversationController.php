<?php

namespace App\Controller\Api;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

#[Route('/api', name: 'api_')]
class ConversationController extends AbstractController
{
    #[Route('/conversations', name: 'conversations_list', methods: ['GET'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function list(EntityManagerInterface $entityManager): JsonResponse
    {
        $user = $this->getUser();

        // Récupère toutes les conversations où le user est participant
        $conversations = $entityManager->getRepository(Conversation::class)
            ->createQueryBuilder('c')
            ->innerJoin('c.participants', 'p')
            ->where('p = :user')
            ->setParameter('user', $user)
            ->getQuery()
            ->getResult();

        $data = [];
        foreach ($conversations as $conversation) {
            $data[] = [
                'id' => $conversation->getId(),
                'title' => $conversation->getTitle(),
            ];
        }

        return $this->json($data, Response::HTTP_OK);
    }
}
