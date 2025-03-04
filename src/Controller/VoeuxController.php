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
        // Vérifier que l'utilisateur est connecté et possède le rôle "ROLE_USER"
        if (!$this->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Vous devez être connecté en tant qu\'utilisateur pour accéder à cette page.');
        }

        // Récupérer tous les projets depuis la base de données
        $projects = $this->projetRepository->findAll();

        // Préparer les options pour les projets
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        // Création du formulaire
        $form = $this->createForm(VoeuxType::class, null, [
            'projets' => $choices,
        ]);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();
            $user = $this->getUser();

            // Supprimer les anciens voeux (optionnel, à implémenter)
            // $this->entityManager->getRepository(Voeux::class)->deleteUserVoeux($user);

            // Sauvegarder chaque voeu
            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;

                if (!empty($data[$projetField])) {
                    $voeux = new Voeux();
                    $voeux->setUser($user);
                    $voeux->setProjet($this->entityManager->getRepository(Projet::class)->find($data[$projetField]));
                    $voeux->setPriorite($i);

                    $this->entityManager->persist($voeux);
                }
            }

            $this->entityManager->flush();

            $this->addFlash('success', 'Vos vœux ont bien été enregistrés !');
            return $this->redirectToRoute('app_voeux');
        }

        return $this->render('voeux/index.html.twig', [
            'form' => $form->createView(),
            'projets' => $projects,
        ]);
    }
}
