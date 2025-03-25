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

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    

        $existingVoeux = $this->entityManager->getRepository(Voeux::class)->findBy(['user' => $user]);

        if (!empty($existingVoeux)) {
            $this->addFlash('error', 'Vous avez déjà enregistré des vœux. Vous ne pouvez pas en ajouter d\'autres.');
            return $this->redirectToRoute('app_profil');
        }

        $projects = $this->projetRepository->findAll();
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        $form = $this->createForm(VoeuxType::class, null, [
            'projets' => $choices,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $selectedProjects = [];

            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;
                if (!empty($data[$projetField])) {
                    $selectedProjects[] = $data[$projetField];
                }
            }

            if (count($selectedProjects) !== 5) {
                $form->addError(new FormError('Vous devez sélectionner exactement 5 projets.'));
            }

            if (count(array_unique($selectedProjects)) < 5) {
                $form->addError(new FormError('Chaque projet doit être unique.'));
            }

            if ($form->getErrors(true)->count() > 0) {
                return $this->render('voeux/index.html.twig', [
                    'form' => $form->createView(),
                    'projets' => $projects,
                ]);
            }

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

        return $this->render('voeux/index.html.twig', [
            'form' => $form->createView(),
            'projets' => $projects,
        ]);
    }

    #[Route('/voeux/edit', name: 'app_voeux_edit')]
    public function edit(Request $request): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    

        $existingVoeux = $this->entityManager->getRepository(Voeux::class)->findBy(['user' => $user]);

        if (count($existingVoeux) !== 5) {
            $this->addFlash('error', 'Vous devez avoir exactement 5 vœux pour modifier votre sélection.');
            return $this->redirectToRoute('app_voeux');
        }

        $projects = $this->projetRepository->findAll();
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        $data = [];


        $form = $this->createForm(VoeuxType::class, $data, [
            'projets' => $choices,
        ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $selectedProjects = [];

            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;
                if (!empty($data[$projetField])) {
                    $selectedProjects[] = $data[$projetField];
                }
            }

            if (count($selectedProjects) !== 5) {
                $this->addFlash('error', 'Vous devez sélectionner exactement 5 projets.');
                return $this->redirectToRoute('app_voeux_edit');
            }

            foreach ($existingVoeux as $voeu) {
                $this->entityManager->remove($voeu);
            }

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

        return $this->render('voeux/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
