<?php

namespace App\Controller;

use App\Service\GroupManager;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AttributionController extends AbstractController
{
    private GroupManager $groupManager;
    private EntityManagerInterface $entityManager;

    // Constructeur pour initialiser les dépendances nécessaires
    public function __construct(GroupManager $groupManager, EntityManagerInterface $entityManager)
    {
        $this->groupManager = $groupManager;
        $this->entityManager = $entityManager;
    }

    #[Route('/generate-groups', name: 'app_generate_groups')]
    // Méthode pour générer et mettre à jour les groupes à partir des attributions
    public function generateGroups(GroupManager $groupManager): Response
    {
        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Si aucun utilisateur n'est connecté, redirige vers la page de connexion
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        // Met à jour les groupes en fonction des attributions
        $groupManager->updateGroupsFromAttributions();

        // Ajoute un message flash pour informer l'utilisateur du succès de l'opération
        $this->addFlash('success', 'Mise à jour des groupes effectuée !');
    
        // Redirige vers la liste des groupes
        return $this->redirectToRoute('app_groups_list');
    }
}
