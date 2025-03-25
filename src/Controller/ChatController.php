<?php

namespace App\Controller;

use App\Entity\Conversation;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorageInterface;
use Symfony\Component\Security\Core\Authentication\Token\Storage\TokenStorage;
use Lexik\Bundle\JWTAuthenticationBundle\Services\JWTTokenManagerInterface as TokenManagerInterface;

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
public function chat(Conversation $conversation, TokenManagerInterface $jwtManager): Response
{
    $user = $this->getUser();
    $token = $jwtManager->create($user);

    return $this->render('chat.html.twig', [
        'conversation' => $conversation,
        'jwt_token' => $token
    ]);
}
}
