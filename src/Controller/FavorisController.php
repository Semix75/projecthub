<?php

namespace App\Controller;

use App\Entity\Favoris;
use App\Entity\Projet;
use App\Repository\FavorisRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Security\Http\Attribute\IsGranted;

class FavorisController extends AbstractController
{
    private $entityManager;
    private $favorisRepository;

    // Constructeur pour initialiser l'EntityManager et le repository des favoris
    public function __construct(EntityManagerInterface $entityManager, FavorisRepository $favorisRepository)
    {
        $this->entityManager = $entityManager;
        $this->favorisRepository = $favorisRepository;
    }

    // Route pour afficher la liste des favoris de l'utilisateur connecté
    #[Route('/favoris', name: 'app_favoris')]
    public function listFavoris(): Response
    {
        $user = $this->getUser();

        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupère les favoris de l'utilisateur
        $favoris = $this->favorisRepository->findBy(['user' => $user]);

        // Rend la vue avec la liste des favoris
        return $this->render('favoris/index.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    // Route pour ajouter ou retirer un projet des favoris (toggle)
    #[Route('/favoris/toggle/{id}', name: 'app_favoris_toggle', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function toggleFavoris(Projet $projet): Response
    {
        $user = $this->getUser();

        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifie si le projet est déjà dans les favoris de l'utilisateur
        $favori = $this->favorisRepository->findOneBy(['user' => $user, 'projet' => $projet]);

        if ($favori) {
            // Si le projet est déjà dans les favoris, le retirer
            $this->entityManager->remove($favori);
            $this->entityManager->flush();
            return $this->json(['status' => 'removed']);
        } else {
            // Sinon, l'ajouter aux favoris
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setProjet($projet);

            $this->entityManager->persist($favori);
            $this->entityManager->flush();
            return $this->json(['status' => 'added']);
        }
    }

    // Route pour supprimer un favori spécifique
    #[Route('/favoris/remove/{id}', name: 'app_favoris_remove', methods: ['POST'])]
    public function remove(Favoris $favori): Response
    {
        $user = $this->getUser();

        // Redirige vers la page de connexion si l'utilisateur n'est pas connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifie que le favori appartient bien à l'utilisateur connecté
        if ($favori->getUser() !== $user) {
            return $this->json(['status' => 'error'], 400);
        }

        // Supprime le favori
        $this->entityManager->remove($favori);
        $this->entityManager->flush();

        return $this->json(['status' => 'removed']);
    }
}
