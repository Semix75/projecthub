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

    public function __construct(GroupManager $groupManager, EntityManagerInterface $entityManager)
    {
        $this->groupManager = $groupManager;
        $this->entityManager = $entityManager;
    }

    #[Route('/generate-groups', name: 'app_generate_groups')]
    public function generateGroups(GroupManager $groupManager): Response
    {
        $user = $this->getUser();

        if (!$user) {
            return $this->redirectToRoute('app_login');
        }
    
        $groupManager->updateGroupsFromAttributions();
        $this->addFlash('success', 'Mise à jour des groupes effectuée !');
    
        return $this->redirectToRoute('app_groups_list');
    }
    
    
}
