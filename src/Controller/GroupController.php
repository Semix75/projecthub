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
        // Récupérer l'utilisateur actuellement connecté
        $user = $security->getUser();

        // Récupérer les groupes où l'utilisateur est membre
        $userGroups = $entityManager->getRepository(Groupe::class)
            ->createQueryBuilder('g') // Créer une requête pour récupérer les groupes
            ->innerJoin('g.users', 'u') // Faire une jointure avec les utilisateurs du groupe
            ->where('u.id = :userId') // Filtrer les groupes où l'utilisateur est membre
            ->setParameter('userId', $user->getId()) // Définir le paramètre de l'utilisateur
            ->getQuery()
            ->getResult(); // Exécuter la requête et obtenir les résultats

        // Récupérer tous les groupes existants dans la base de données
        $allGroups = $entityManager->getRepository(Groupe::class)->findAll();

        // Rendre la vue Twig avec les données des groupes
        return $this->render('group/list.html.twig', [
            'userGroups' => $userGroups, // Groupes où l'utilisateur est membre
            'allGroups' => $allGroups, // Tous les groupes existants
        ]);
    }
}
