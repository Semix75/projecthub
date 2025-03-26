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
    // Route pour afficher la liste des projets
    #[Route('/projets', name: 'projets_index')]
    public function index(ProjetRepository $projetRepository, FavorisRepository $favorisRepository): Response
    {
        // Récupération de tous les projets
        $projets = $projetRepository->findAll();
        $user = $this->getUser();

        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupération des favoris de l'utilisateur connecté
        $favoris = $user ? $favorisRepository->findBy(['user' => $user]) : [];

        // Rendu de la vue avec les projets et les favoris
        return $this->render('projet/index.html.twig', [
            'projets' => $projets,
            'favoris' => array_map(fn($favori) => $favori->getProjet(), $favoris)
        ]);
    }

    // Route pour afficher les détails d'un projet spécifique
    #[Route('/projet/{id}', name: 'projet_detail')]
    public function detail(int $id, ProjetRepository $projetRepository, FavorisRepository $favorisRepository): Response
    {
        // Récupération du projet par son ID
        $projet = $projetRepository->find($id);
        $user = $this->getUser();

        // Redirection vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Gestion du cas où le projet n'existe pas
        if (!$projet) {
            throw $this->createNotFoundException("Projet non trouvé.");
        }

        // Récupération des projets favoris de l'utilisateur
        $favoris = array_map(fn($favori) => $favori->getProjet(), $favorisRepository->findBy(['user' => $user]));

        // Rendu de la vue avec les détails du projet et les favoris
        return $this->render('projet/detail.html.twig', [
            'projet' => $projet,
            'favoris' => $favoris, 
        ]);
    }

    // Route pour ajouter un projet aux favoris
    #[Route('/favoris/add/{id}', name: 'favoris_add')]
    public function addFavoris(Projet $projet, EntityManagerInterface $entityManager, FavorisRepository $favorisRepository): Response
    {
        $user = $this->getUser();

        // Vérification si l'utilisateur est connecté
        if (!$user) {
            $this->addFlash('error', 'Vous devez être connecté pour ajouter un favori.');
            return $this->redirectToRoute('projets_index');
        }

        // Vérification si le projet est déjà dans les favoris
        $existingFavori = $favorisRepository->findOneBy(['user' => $user, 'projet' => $projet]);

        if ($existingFavori) {
            $this->addFlash('info', 'Ce projet est déjà dans vos favoris.');
        } else {
            // Ajout du projet aux favoris
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setProjet($projet);

            $entityManager->persist($favori);
            $entityManager->flush();

            $this->addFlash('success', 'Projet ajouté aux favoris !');
        }

        // Redirection vers la liste des projets
        return $this->redirectToRoute('projets_index');
    }

    // Route pour supprimer un projet des favoris
    #[Route('/favoris/remove/{id}', name: 'favoris_remove')]
    public function removeFavoris(Favoris $favori, EntityManagerInterface $entityManager): Response
    {
        // Suppression du favori
        $entityManager->remove($favori);
        $entityManager->flush();

        $this->addFlash('success', 'Favori supprimé avec succès.');
        // Redirection vers la liste des projets
        return $this->redirectToRoute('projets_index');
    }
}
