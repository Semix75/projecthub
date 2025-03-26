<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Entity\Projet;
use App\Repository\FavorisRepository;
use App\Repository\ProjetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;

class ProjetController extends AbstractController
{
    #[Route('/projets', name: 'projets_index')]
    public function index(ProjetRepository $projetRepository, FavorisRepository $favorisRepository): Response
    {
    
        $projets = $projetRepository->findAll();
        $user = $this->getUser();
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        $favoris = $user ? $favorisRepository->findBy(['user' => $user]) : [];

        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
            'favoris' => array_map(fn($favori) => $favori->getProjet(), $favoris)
        ]);
    }


    #[Route('/projet/{id}', name: 'projet_detail')]
    public function detail(int $id, ProjetRepository $projetRepository, FavorisRepository $favorisRepository): Response
    {
        $projet = $projetRepository->find($id);
        $user = $this->getUser();
    
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        if (!$projet) {
            throw $this->createNotFoundException("Projet non trouvé.");
        }
    
        $favoris = array_map(fn($favori) => $favori->getProjet(), $favorisRepository->findBy(['user' => $user]));
    
        return $this->render('projet/detail.html.twig', [
            'projet' => $projet,
            'favoris' => $favoris, 
        ]);
    }
    

    #[Route('/favoris/add/{id}', name: 'favoris_add')]
    public function addFavoris(Projet $projet, EntityManagerInterface $entityManager, FavorisRepository $favorisRepository): Response
    {
        $user = $this->getUser();

        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un favori.');
            return $this->redirectToRoute('projets_index');
        }

        $existingFavori = $favorisRepository->findOneBy(['user' => $user, 'projet' => $projet]);

        if ($existingFavori) {
            $this->addFlash('info', 'Ce projet est déjà dans vos favoris.');
        } else {
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setProjet($projet);

            $entityManager->persist($favori);
            $entityManager->flush();

            $this->addFlash('success', 'Projet ajouté aux favoris !');
        }

        return $this->redirectToRoute('projets_index');
    }

    #[Route('/favoris/remove/{id}', name: 'favoris_remove')]
    public function removeFavoris(Favoris $favori, EntityManagerInterface $entityManager): Response
    {
        $entityManager->remove($favori);
        $entityManager->flush();

        $this->addFlash('success', 'Favori supprimé avec succès.');
        return $this->redirectToRoute('projets_index');
    }
}
