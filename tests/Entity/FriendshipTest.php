<?php

namespace App\Tests\Entity;

use App\Entity\Friendship;
use App\Entity\User;
use PHPUnit\Framework\TestCase;

class FriendshipTest extends TestCase
{
    public function testInitialValues()
    {
        $friendship = new Friendship();

        $this->assertSame(Friendship::STATUS_PENDING, $friendship->getStatus());
        $this->assertNotNull($friendship->getCreatedAt());
        $this->assertNull($friendship->getUpdatedAt());
        $this->assertNull($friendship->getRequester());
        $this->assertNull($friendship->getReceiver());
        $this->assertNull($friendship->getBlockedBy());
        $this->assertNull($friendship->getFriendAt());
    }

    public function testSettersAndGetters()
    {
        $friendship = new Friendship();
        $user1 = new User();
        $user2 = new User();
        $date = new \DateTime();

        $friendship->setRequester($user1);
        $this->assertSame($user1, $friendship->getRequester());

        $friendship->setReceiver($user2);
        $this->assertSame($user2, $friendship->getReceiver());

        $friendship->setStatus(Friendship::STATUS_ACCEPTED);
        $this->assertSame(Friendship::STATUS_ACCEPTED, $friendship->getStatus());

        $friendship->setBlockedBy(3);
        $this->assertSame(3, $friendship->getBlockedBy());

        $friendship->setUpdatedAt($date);
        $this->assertSame($date, $friendship->getUpdatedAt());

        $friendship->setFriendAt($date);
        $this->assertSame($date, $friendship->getFriendAt());
    }
}
