<?php

namespace App\Controller;

use App\Entity\Groupe;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\Routing\Annotation\Route;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;

class GroupController extends AbstractController
{
    #[Route('/groups', name: 'app_groups_list')]
    public function listGroups(EntityManagerInterface $entityManager, Security $security): Response
    {
        $user = $security->getUser();

        // Récupérer les groupes où l'utilisateur est membre
        $userGroups = $entityManager->getRepository(Groupe::class)
            ->createQueryBuilder('g')
            ->innerJoin('g.users', 'u')
            ->where('u.id = :userId')
            ->setParameter('userId', $user->getId())
            ->getQuery()
            ->getResult();

        // Récupérer tous les groupes existants
        $allGroups = $entityManager->getRepository(Groupe::class)->findAll();

        

        return $this->render('group/list.html.twig', [
            'userGroups' => $userGroups,
            'allGroups' => $allGroups,
        ]);
    }
}
