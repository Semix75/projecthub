<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\ProjetRepository;


final class HomePageController extends AbstractController
{
    #[Route('/', name: 'app_home_page')] #[Route('/', name: 'home')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findBy([], ['id' => 'DESC'], 3); // Afficher les 3 derniers projets

        return $this->render('home_page/index.html.twig', [
            'projets' => $projets,
        ]);
    }
}
