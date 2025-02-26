<?php
// src/Controller/ProjetController.php
namespace App\Controller;

use App\Repository\ProjetRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProjetController extends AbstractController
{
    #[Route('/projets', name: 'projets_index')]
    public function index(ProjetRepository $projetRepository): Response
    {
        $projets = $projetRepository->findAll();
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
        ]);
    }


    #[Route('/projet/{id}', name: 'projet_detail')]
public function detail(int $id, ProjetRepository $projetRepository): Response
{
    $projet = $projetRepository->find($id);

    if (!$projet) {
        throw $this->createNotFoundException("Projet non trouvé.");
    }

    return $this->render('projet/detail.html.twig', [
        'projet' => $projet,
    ]);
}

}
