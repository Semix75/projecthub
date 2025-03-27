<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProjetRepository;

// Contrôleur pour la page d'accueil
final class HomePageController extends AbstractController
{
    // Route pour la page d'accueil (accessible via '/')
    #[Route('/', name: 'app_home_page')] #[Route('/', name: 'home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        // Récupérer les 3 derniers projets triés par ordre décroissant d'ID
        $projets = $projetRepository->findBy([], ['id' => 'DESC'], 3);

        // Rendre la vue Twig pour la page d'accueil avec les projets récupérés
        return $this->render('home_page/index.html.twig', [
            'projets' => $projets,
        ]);
    }
}
