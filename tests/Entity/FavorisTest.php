<?php

namespace App\Tests\Entity;

use App\Entity\Favoris;
use App\Entity\User;
use App\Entity\Projet;
use PHPUnit\Framework\TestCase;

class FavorisTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $favoris = new Favoris();

        // Test de l'ID (devrait être null avant persistance)
        $this->assertNull($favoris->getId());

        // Test de l'association avec un utilisateur
        $user = new User();
        $favoris->setUser($user);
        $this->assertSame($user, $favoris->getUser());

        // Test de l'association avec un projet
        $projet = new Projet();
        $favoris->setProjet($projet);
        $this->assertSame($projet, $favoris->getProjet());
    }
}
