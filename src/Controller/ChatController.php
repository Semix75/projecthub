<?php

namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface;

final class ChatController extends AbstractController
{
    #[Route('/chat', name: 'app_chat')]
    public function index(): Response
    {
        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
        ]);
    }

    #[Route('/chat/{id}', name: 'app_chat')]
    public function chat(Conversation $conversation, JWTTokenManagerInterface $jwtManager): Response
    {
        $token = $jwtManager->create($this->getUser());

        return $this->render('chat/chat.html.twig', [
            'conversation' => $conversation,
            'jwt_token' => $token
        ]);
    }

}
