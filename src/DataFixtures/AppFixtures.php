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
        // Création des utilisateurs
        $users = [];
        for ($i = 1; $i <= 5; $i++) {
            $user = new User();
            $user->setFirstname("Nom $i");
            $user->setLastname("Prénom $i");
            $user->setEmail("pipi$i@example.com");
            $user->setRoles(['ROLE_USER']);
            $user->setPassword($this->passwordHasher->hashPassword($user, 'password'));
            $user->setUsername("pipi$i");
            $user->setBiographie("Biographie de l'utilisateur $i");
            $user->setLastOnline(new \DateTimeImmutable());
            $this->addReference("user_$i", $user);


            $manager->persist($user);
            $users[] = $user;
        }

         // Création des conversations
    $conversations = [];
    for ($i = 1; $i <= 3; $i++) {
        $conversation = new Conversation();
        $conversation->setTitle("Conversation $i");
        $conversation->setCreatedAt(new \DateTimeImmutable());
        $conversation->setCreatedBy($users[array_rand($users)]);

        // Ajout de participants
        foreach (array_rand($users, 3) as $userIndex) {
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
        $friendship = new Friendship();
        $friendship->setRequester($users[array_rand($users)]);
        $friendship->setReceiver($users[array_rand($users)]);
        $friendship->setStatus(Friendship::STATUS_PENDING);
        $friendship->setCreatedAt(new \DateTime());
        $friendship->setUpdatedAt(new \DateTime());

        $manager->persist($friendship);
    }

        // Création des projets
        $projets = [];
        for ($i = 1; $i <= 3; $i++) {
            $projet = new Projet();
            $projet->setIntitule("Projet $i");
            $projet->setNbPlaceMin(1);
            $projet->setNbPlaceMax(5);            
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
