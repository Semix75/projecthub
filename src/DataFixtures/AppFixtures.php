<?php
namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Voeux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création des utilisateurs
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setFirstname("Nom $i");
            $user->setLastname("Prénom $i");
            $user->setEmail("user$i@example.com");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

            $manager->persist($user);
            $users[] = $user;
        }

        // Création des projets
        $projets = [];
        for ($i = 1; $i <= 3; $i++) {
            $projet = new Projet();
            $projet->setIntitule("Projet $i");
            $projet->setNbPlace(rand(2, 5));
            $projet->setDescription("Description du projet $i");

            $manager->persist($projet);
            $projets[] = $projet;
        }

        // Création des vœux (chaque user choisit aléatoirement un projet)
        foreach ($users as $user) {
            $voeux = new Voeux();
            $voeux->setUser($user);
            $voeux->setProjet($projets[array_rand($projets)]); // Choix aléatoire d'un projet

            $manager->persist($voeux);
        }

        $manager->flush();
    }
}
