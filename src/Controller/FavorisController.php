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

    public function __construct(EntityManagerInterface $entityManager, FavorisRepository $favorisRepository)
    {
        $this->entityManager = $entityManager;
        $this->favorisRepository = $favorisRepository;
    }

    #[Route('/favoris', name: 'app_favoris')]
    public function listFavoris(): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $favoris = $this->favorisRepository->findBy(['user' => $user]);

        return $this->render('favoris/index.html.twig', [
            'favoris' => $favoris,
        ]);
    }

    #[Route('/favoris/toggle/{id}', name: 'app_favoris_toggle', methods: ['POST'])]
    #[IsGranted('IS_AUTHENTICATED_FULLY')]
    public function toggleFavoris(Projet $projet): Response
    {
        $user = $this->getUser();
        $favori = $this->favorisRepository->findOneBy(['user' => $user, 'projet' => $projet]);

        if ($favori) {
            $this->entityManager->remove($favori);
            $this->entityManager->flush();
            return $this->json(['status' => 'removed']);
        } else {
            $favori = new Favoris();
            $favori->setUser($user);
            $favori->setProjet($projet);

            $this->entityManager->persist($favori);
            $this->entityManager->flush();
            return $this->json(['status' => 'added']);
        }
    }

    #[Route('/favoris/remove/{id}', name: 'app_favoris_remove', methods: ['POST'])]
    public function remove(Favoris $favori): Response
    {
        $user = $this->getUser();

        if ($favori->getUser() !== $user) {
            return $this->json(['status' => 'error'], 400);
        }

        $this->entityManager->remove($favori);
        $this->entityManager->flush();

        return $this->json(['status' => 'removed']);
    }
}
