<?php

namespace App\DataFixtures;

use App\Entity\Conversation;
use App\Entity\Message;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

class MessagesConversationsFixtures extends Fixture implements FixtureGroupInterface
{
    public static function getGroups(): array
    {
        return ['messages_conversations'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupérer tous les utilisateurs
        $users = $manager->getRepository(User::class)->findAll();

        if (count($users) < 2) {
            throw new \Exception('Vous devez avoir au moins 2 utilisateurs pour générer des conversations.');
        }

        // Créer des conversations
        for ($i = 1; $i <= 3; $i++) {
            $conversation = new Conversation();
            $conversation->setTitle("Conversation $i");
            $conversation->setCreatedBy($users[array_rand($users)]); // Créateur aléatoire
            $conversation->addParticipant($users[array_rand($users)]); // Participant aléatoire
            $conversation->addParticipant($users[array_rand($users)]); // Un autre participant aléatoire

            $manager->persist($conversation);

            // Créer des messages pour chaque conversation
            for ($j = 1; $j <= 5; $j++) {
                $message = new Message();
                $message->setContent("Message $j dans la conversation $i");
                $message->setSendAt(new \DateTime());
                $message->setIsRead(false);
                $message->setSendBy($users[array_rand($users)]); // Expéditeur aléatoire
                $message->setConversation($conversation);

                $manager->persist($message);
            }
        }

        $manager->flush();
    }
}