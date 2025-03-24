<?php

namespace App\DataFixtures;

use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Voeux;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\Friendship;

class AppFixtures extends Fixture
{
    private UserPasswordHasherInterface $passwordHasher;

    public function __construct(UserPasswordHasherInterface $passwordHasher)
    {
        $this->passwordHasher = $passwordHasher;
    }

    public function load(ObjectManager $manager): void
    {
        // Création des projets
        $projetData = [
            1 => ['Projet A', 2, 4],
            2 => ['Projet B', 4, 5],
            3 => ['Projet C', 3, 4],
            4 => ['Projet D', 3, 5],
            5 => ['Projet E', 2, 3],
            6 => ['Projet F', 1, 2],
            7 => ['Projet G', 2, 4],
            8 => ['Projet H', 3, 4],
        ];

        foreach ($projetData as $id => [$intitule, $min, $max]) {
            $projet = new Projet();
            $projet->setIntitule($intitule);
            $projet->setNbPlaceMin($min);
            $projet->setNbPlaceMax($max);
            $projet->setDescription("Description de $intitule");

            $manager->persist($projet);
            $this->addReference("projet_$id", $projet);
        }

        // Création des utilisateurs
        $eleves = [
            ['b', 'b', []],
            ['Alice', 'Durand',     [1, 6, 3, 7, 5]],
            ['Bob', 'Lemoine',      [2, 3, 8, 5, 4]],
            ['Charlie', 'Bernard',  [6, 3, 2, 4, 7]],
            ['David', 'Moreau',     [3, 1, 2, 5, 8]],
            ['Eve', 'Garcia',       [2, 7, 3, 6, 5]],
            ['Frank', 'Perrin',     [5, 8, 1, 2, 4]],
            ['Grace', 'Faure',      [4, 2, 7, 3, 1]],
            ['Hank', 'Lambert',     [3, 5, 2, 8, 4]],
            ['Ivy', 'Roux',         [1, 4, 5, 7, 3]],
            ['Jack', 'Blanchard',   [5, 2, 6, 3, 8]],
            ['Karen', 'Collet',     [6, 7, 8, 1, 3]],
            ['Leo', 'Noël',         [7, 8, 6, 2, 4]],
            ['Mia', 'Marchand',     [8, 6, 7, 3, 5]],
            ['Nina', 'Gonzalez',    [6, 3, 1, 2, 4]],
            ['Oscar', 'Barbier',    [7, 5, 4, 1, 6]],
            ['Paul', 'Chevalier',   [1, 5, 3, 7, 6]],
            ['Quentin', 'Renaud',   [2, 6, 4, 8, 5]],
            ['Rachel', 'Bourgeois', [3, 7, 1, 5, 2]],
            ['Sophie', 'Masson',    [4, 8, 6, 2, 1]],
            ['Tom', 'Rodriguez',    [5, 1, 7, 3, 4]],
            ['Ursula', 'Fernandez', [6, 2, 8, 4, 7]],
            ['Victor', 'Benoit',    [7, 3, 5, 1, 8]],
            ['Wendy', 'Leclerc',    [8, 4, 2, 6, 3]],
            ['Xavier', 'Lopez',     [1, 7, 5, 3, 2]],
            ['Yasmine', 'Carpentier',[2, 5, 8, 6, 4]],
            ['Zack', 'Delattre',    [3, 6, 1, 4, 7]],
        ];

        $users = [];

        foreach ($eleves as $index => [$prenom, $nom, $voeuxIds]) {
            $user = new User();
            $user->setFirstname($prenom);
            $user->setLastname($nom);
            $user->setEmail(strtolower($prenom) . "@example.com");
            $user->setUsername(strtolower($prenom));
            $user->setRoles(['ROLE_USER']);
            $user->setBiographie("Biographie de $prenom $nom");
            $user->setLastOnline(new \DateTimeImmutable());
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));

            $manager->persist($user);
            $users[] = $user;

            // Ajout d'une référence pour chaque user
            $this->addReference('user_' . strtolower($prenom), $user);

            // Création des vœux
            foreach ($voeuxIds as $i => $projetId) {
                $voeu = new Voeux();
                $voeu->setUser($user);
                $voeu->setProjet($this->getReference("projet_$projetId", Projet::class));
                $voeu->setPriorite($i + 1); // priorité va de 1 à 5
                $manager->persist($voeu);
            }

        }

        // Création des conversations
        $conversations = [];
        for ($i = 1; $i <= 3; $i++) {
            $conversation = new Conversation();
            $conversation->setTitle("Conversation $i");
            $conversation->setCreatedAt(new \DateTimeImmutable());
            $conversation->setCreatedBy($users[array_rand($users)]);

            // Ajout de participants
            foreach ((array) array_rand($users, 3) as $userIndex) {
                $conversation->addParticipant($users[$userIndex]);
            }

            $manager->persist($conversation);
            $conversations[] = $conversation;
        }

        // Création des messages
        for ($i = 1; $i <= 10; $i++) {
            $message = new Message();
            $message->setContent("Message $i");
            $message->setSendAt(new \DateTime());
            $message->setIsRead(false);
            $message->setSendBy($users[array_rand($users)]);
            $message->setConversation($conversations[array_rand($conversations)]);

            $manager->persist($message);
        }

        // Création des amitiés
        for ($i = 1; $i <= 5; $i++) {
            do {
                $requester = $users[array_rand($users)];
                $receiver = $users[array_rand($users)];
            } while ($requester === $receiver);

            $friendship = new Friendship();
            $friendship->setRequester($requester);
            $friendship->setReceiver($receiver);
            $friendship->setStatus(Friendship::STATUS_PENDING);
            $friendship->setCreatedAt(new \DateTime());
            $friendship->setUpdatedAt(new \DateTime());

            $manager->persist($friendship);
        }

        $manager->flush();
    }
}
