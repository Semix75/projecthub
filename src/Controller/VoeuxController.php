<?php

namespace App\Controller;

use App\Entity\Voeux;
use App\Form\VoeuxType;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;
use App\Repository\ProjetRepository;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Form\FormError;

class VoeuxController extends AbstractController
{
    private $entityManager;
    private $projetRepository;

    public function __construct(EntityManagerInterface $entityManager, ProjetRepository $projetRepository)
    {
        $this->entityManager = $entityManager;
        $this->projetRepository = $projetRepository;
    }

    #[Route('/voeux', name: 'app_voeux')]
    public function new(Request $request): Response
    {
        $user = $this->getUser();

        // Vérifie si l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifie si l'utilisateur a déjà enregistré des vœux
        $existingVoeux = $this->entityManager->getRepository(Voeux::class)->findBy(['user' => $user]);

        if (!empty($existingVoeux)) {
            $this->addFlash('error', 'Vous avez déjà enregistré des vœux. Vous ne pouvez pas en ajouter d\'autres.');
            return $this->redirectToRoute('app_profil');
        }

        // Récupère tous les projets disponibles
        $projects = $this->projetRepository->findAll();
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        // Crée le formulaire pour les vœux
        $form = $this->createForm(VoeuxType::class, null, [
            'projets' => $choices,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $selectedProjects = [];

            // Récupère les projets sélectionnés
            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;
                if (!empty($data[$projetField])) {
                    $selectedProjects[] = $data[$projetField];
                }
            }

            // Vérifie que 5 projets ont été sélectionnés
            if (count($selectedProjects) !== 5) {
                $form->addError(new FormError('Vous devez sélectionner exactement 5 projets.'));
            }

            // Vérifie que chaque projet est unique
            if (count(array_unique($selectedProjects)) < 5) {
                $form->addError(new FormError('Chaque projet doit être unique.'));
            }

            // Si le formulaire contient des erreurs, retourne la vue avec les erreurs
            if ($form->getErrors(true)->count() > 0) {
                return $this->render('voeux/index.html.twig', [
                    'form' => $form->createView(),
                    'projets' => $projects,
                ]);
            }

            // Enregistre les vœux dans la base de données
            foreach ($selectedProjects as $index => $projetId) {
                $voeu = new Voeux();
                $voeu->setUser($user);
                $voeu->setProjet($this->entityManager->getRepository(Projet::class)->find($projetId));
                $voeu->setPriorite($index + 1);

                $this->entityManager->persist($voeu);
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Vos vœux ont bien été enregistrés !');
            return $this->redirectToRoute('app_profil');
        }

        // Affiche le formulaire pour enregistrer les vœux
        return $this->render('voeux/index.html.twig', [
            'form' => $form->createView(),
            'projets' => $projects,
        ]);
    }

    #[Route('/voeux/edit', name: 'app_voeux_edit')]
    public function edit(Request $request): Response
    {
        $user = $this->getUser();

        // Vérifie si l'utilisateur est connecté
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        // Récupère les vœux existants de l'utilisateur
        $existingVoeux = $this->entityManager->getRepository(Voeux::class)->findBy(['user' => $user]);

        // Vérifie que l'utilisateur a exactement 5 vœux
        if (count($existingVoeux) !== 5) {
            $this->addFlash('error', 'Vous devez avoir exactement 5 vœux pour modifier votre sélection.');
            return $this->redirectToRoute('app_voeux');
        }

        // Récupère tous les projets disponibles
        $projects = $this->projetRepository->findAll();
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        $data = [];

        // Crée le formulaire pour modifier les vœux
        $form = $this->createForm(VoeuxType::class, $data, [
            'projets' => $choices,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $selectedProjects = [];

            // Récupère les projets sélectionnés
            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;
                if (!empty($data[$projetField])) {
                    $selectedProjects[] = $data[$projetField];
                }
            }

            // Vérifie que 5 projets ont été sélectionnés
            if (count($selectedProjects) !== 5) {
                $this->addFlash('error', 'Vous devez sélectionner exactement 5 projets.');
                return $this->redirectToRoute('app_voeux_edit');
            }

            // Supprime les anciens vœux
            foreach ($existingVoeux as $voeu) {
                $this->entityManager->remove($voeu);
            }

            // Enregistre les nouveaux vœux
            foreach ($selectedProjects as $index => $projetId) {
                $voeu = new Voeux();
                $voeu->setUser($user);
                $voeu->setProjet($this->entityManager->getRepository(Projet::class)->find($projetId));
                $voeu->setPriorite($index + 1);
                $this->entityManager->persist($voeu);
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Vos vœux ont bien été mis à jour !');
            return $this->redirectToRoute('app_profil');
        }

        // Affiche le formulaire pour modifier les vœux
        return $this->render('voeux/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
