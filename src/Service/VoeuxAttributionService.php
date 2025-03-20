<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Attribution;
use Doctrine\ORM\EntityManagerInterface;

class VoeuxAttributionService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function attribuerProjets(): void
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $projets = $this->entityManager->getRepository(Projet::class)->findAll();

        foreach ($users as $user) {
            $randomProjet = $projets[array_rand($projets)]; // Attribution fictive
            $attribution = new Attribution();
            $attribution->setUser($user);
            $attribution->setProjet($randomProjet);

            $this->entityManager->persist($attribution);
        }

        $this->entityManager->flush();
    }
}