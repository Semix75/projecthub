<?php

namespace App\Tests\Entity;

use App\Entity\Message;
use App\Entity\User;
use App\Entity\Conversation;
use PHPUnit\Framework\TestCase;

class MessageTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $message = new Message();
        
        // Test content
        $message->setContent("Hello World");
        $this->assertSame("Hello World", $message->getContent());

        // Test sendAt
        $sendAt = new \DateTime();
        $message->setSendAt($sendAt);
        $this->assertSame($sendAt, $message->getSendAt());

        // Test isRead
        $message->setIsRead(true);
        $this->assertTrue($message->isRead());

        // Test readAt
        $readAt = new \DateTimeImmutable();
        $message->setReadAt($readAt);
        $this->assertSame($readAt, $message->getReadAt());

        // Test sendBy (User)
        $user = new User();
        $message->setSendBy($user);
        $this->assertSame($user, $message->getSendBy());

        // Test conversation
        $conversation = new Conversation();
        $message->setConversation($conversation);
        $this->assertSame($conversation, $message->getConversation());
    }
}
