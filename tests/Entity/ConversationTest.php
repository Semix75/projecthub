<?php

namespace App\Tests\Entity;

use App\Entity\Conversation;
use App\Entity\User;
use App\Entity\Message;
use PHPUnit\Framework\TestCase;

class ConversationTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $conversation = new Conversation();

        // Test de l'ID (doit être null avant persistance)
        $this->assertNull($conversation->getId());

        // Test du titre
        $title = "Test Conversation";
        $conversation->setTitle($title);
        $this->assertSame($title, $conversation->getTitle());

        // Test de la date de création
        $createdAt = new \DateTimeImmutable();
        $conversation->setCreatedAt($createdAt);
        $this->assertSame($createdAt, $conversation->getCreatedAt());

        // Test de l'utilisateur créateur
        $user = new User();
        $conversation->setCreatedBy($user);
        $this->assertSame($user, $conversation->getCreatedBy());
    }

    public function testParticipantsManagement()
    {
        $conversation = new Conversation();
        $user1 = new User();
        $user2 = new User();

        // Ajout de participants
        $conversation->addParticipant($user1);
        $conversation->addParticipant($user2);

        $this->assertCount(2, $conversation->getParticipants());
        $this->assertTrue($conversation->getParticipants()->contains($user1));
        $this->assertTrue($conversation->getParticipants()->contains($user2));

        // Suppression d'un participant
        $conversation->removeParticipant($user1);
        $this->assertCount(1, $conversation->getParticipants());
        $this->assertFalse($conversation->getParticipants()->contains($user1));
    }

    public function testMessagesManagement()
    {
        $conversation = new Conversation();
        $message1 = new Message();
        $message2 = new Message();

        // Ajout de messages
        $conversation->addMessage($message1);
        $conversation->addMessage($message2);

        $this->assertCount(2, $conversation->getMessages());
        $this->assertTrue($conversation->getMessages()->contains($message1));
        $this->assertTrue($conversation->getMessages()->contains($message2));

        // Suppression d'un message
        $conversation->removeMessage($message1);
        $this->assertCount(1, $conversation->getMessages());
        $this->assertFalse($conversation->getMessages()->contains($message1));

        // Vérification que le message supprimé n'a plus de conversation associée
        $this->assertNull($message1->getConversation());
    }
}
