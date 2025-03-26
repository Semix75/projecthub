<?php

namespace App\Tests\Entity;

use App\Entity\Attribution;
use App\Entity\User;
use App\Entity\Projet;
use PHPUnit\Framework\TestCase;

class AttributionTest extends TestCase
{
    public function testGettersAndSetters()
    {
        // Création d'une instance de l'entité Attribution
        $attribution = new Attribution();

        // Vérification que l'ID est initialement null
        $this->assertNull($attribution->getId());

        // Création de faux objets User et Projet
        $user = new User();
        $projet = new Projet();

        // Test du setter et getter pour User
        $attribution->setUser($user);
        $this->assertSame($user, $attribution->getUser());

        // Test du setter et getter pour Projet
        $attribution->setProjet($projet);
        $this->assertSame($projet, $attribution->getProjet());
    }
}
