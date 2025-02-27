<?php

namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

final class EtudiantController extends AbstractController
{
    #[Route('/etudiant', name: 'app_etudiant')]
    #[IsGranted('IS_AUTHENTICATED_FULLY')] // Seuls les utilisateurs connectés peuvent accéder
    public function etudiantPage(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll(); // Récupère tous les projets

        return $this->render('etudiant/index.html.twig', [
            'user' => $this->getUser(), 
            'projets' => $projets, // Envoi des projets au template
        ]);
    }
}
