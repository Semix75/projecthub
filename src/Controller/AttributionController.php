<?php

namespace App\Controller;

use App\Service\GroupManager;
use App\Service\VoeuxAttributionService;
use App\Controller\Admin\AttributionCrudController;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
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
        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Si aucun utilisateur n'est connecté, redirige vers la page de connexion
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $groupManager->updateGroupsFromAttributions();
        $this->addFlash('success', 'Mise à jour des groupes effectuée !');

        return $this->redirectToRoute('app_groups_list');
    }

    #[Route('/attribuer', name: 'attribuer_voeux')]
    public function attribuer(Request $request, VoeuxAttributionService $service): RedirectResponse
    {
        // Récupère l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Si aucun utilisateur n'est connecté, redirige vers la page de connexion
        if (!$user) {
            return $this->redirectToRoute('app_login');
        }

        $service->attribuerProjets();
        $this->addFlash('success', 'Attribution effectuée avec succès.');

        return $this->redirect($request->headers->get('referer'));
    }
}
