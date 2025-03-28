<?php

namespace App\Tests\Entity;

use App\Entity\Groupe;
use App\Entity\Projet;
use App\Entity\User;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\ArrayCollection;

class GroupeTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $groupe = new Groupe();
        $groupe->setNom("Team Alpha");

        $this->assertSame("Team Alpha", $groupe->getNom());

        $projet = new Projet();
        $groupe->setProjet($projet);

        $this->assertSame($projet, $groupe->getProjet());
    }

    public function testAddAndRemoveUser()
    {
        $groupe = new Groupe();
        $user = new User();

        $this->assertCount(0, $groupe->getUsers());

        $groupe->addUser($user);
        $this->assertCount(1, $groupe->getUsers());
        $this->assertTrue($groupe->getUsers()->contains($user));

        $groupe->removeUser($user);
        $this->assertCount(0, $groupe->getUsers());
    }

    public function testCreatedAt()
    {
        $groupe = new Groupe();
        $this->assertInstanceOf(\DateTimeInterface::class, $groupe->getCreatedAt());
    }
}
