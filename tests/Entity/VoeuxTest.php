<?php

namespace App\Tests\Entity;

use App\Entity\Voeux;
use App\Entity\User;
use App\Entity\Projet;
use PHPUnit\Framework\TestCase;

class VoeuxTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $user = $this->getMockBuilder(User::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $projet = new Projet();

        $voeu = new Voeux();

        // Test de l'ID (devrait être null avant persistance)
        $this->assertNull($voeu->getId());

        // Test de l'utilisateur
        $voeu->setUser($user);
        $this->assertSame($user, $voeu->getUser());

        // Test du projet
        $voeu->setProjet($projet);
        $this->assertSame($projet, $voeu->getProjet());

        // Test de la priorité
        $voeu->setPriorite(2);
        $this->assertSame(2, $voeu->getPriorite());
    }

    public function testConstructor()
    {
        $user = $this->getMockBuilder(User::class)
                     ->disableOriginalConstructor()
                     ->getMock();

        $projet = $this->getMockBuilder(Projet::class)
                       ->disableOriginalConstructor()
                       ->getMock();

        $priorite = 1;

        $voeu = new Voeux($user, $projet, $priorite);

        $this->assertSame($user, $voeu->getUser());
        $this->assertSame($projet, $voeu->getProjet());
        $this->assertSame($priorite, $voeu->getPriorite());
    }
}
