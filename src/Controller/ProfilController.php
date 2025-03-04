<?php

namespace App\Controller;

use App\Repository\VoeuxRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(VoeuxRepository $voeuxRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour voir votre profil.");
        }

        // Récupérer les vœux de l'utilisateur, triés par priorité
        $voeux = $voeuxRepository->findBy(
            ['user' => $user],
            ['priorite' => 'ASC']
        );

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'voeux' => $voeux,
        ]);
    }
}
