<?php

namespace App\Service;

use App\Entity\Groupe;
use App\Entity\Attribution;
use Doctrine\ORM\EntityManagerInterface;

class GroupManager
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function updateGroupsFromAttributions(): void
    {
        // Récupérer toutes les attributions
        $attributions = $this->entityManager->getRepository(Attribution::class)->findAll();

        // Grouper les attributions par projet
        $groupedAttributions = [];
        foreach ($attributions as $attribution) {
            $projectId = $attribution->getProjet()->getId();
            $groupedAttributions[$projectId][] = $attribution->getUser();
        }

        // Vérifier et mettre à jour les groupes
        foreach ($groupedAttributions as $projectId => $users) {
            // Vérifier si un groupe existe déjà pour ce projet
            $group = $this->entityManager->getRepository(Groupe::class)
                ->findOneBy(['projet' => $projectId]);

            if (!$group) {
                // Créer un nouveau groupe s'il n'existe pas
                $group = new Groupe();
                $group->setNom("Groupe du Projet $projectId");
                $group->setProjet($this->entityManager->getRepository(Attribution::class)
                    ->findOneBy(['projet' => $projectId])
                    ->getProjet());
                $this->entityManager->persist($group);
            }

            // Mettre à jour les utilisateurs du groupe
            foreach ($users as $user) {
                if (!$group->getUsers()->contains($user)) {
                    $group->addUser($user);
                }
            }

            $this->entityManager->persist($group);
        }

        // Vérifier si certains utilisateurs ne sont plus attribués et les retirer des groupes
        $allGroups = $this->entityManager->getRepository(Groupe::class)->findAll();
        foreach ($allGroups as $group) {
            foreach ($group->getUsers() as $user) {
                $isStillAttributed = $this->entityManager->getRepository(Attribution::class)
                    ->findOneBy(['user' => $user, 'projet' => $group->getProjet()]);
                if (!$isStillAttributed) {
                    $group->removeUser($user);
                    if ($group->getUsers()->isEmpty()) {
                        $this->entityManager->remove($group); // Supprimer un groupe vide
                    }
                }
            }
        }

        $this->entityManager->flush();
    }
}
