<?php

namespace App\Tests\Entity;

use App\Entity\Projet;
use App\Entity\Voeux;
use PHPUnit\Framework\TestCase;
use Doctrine\Common\Collections\Collection;

class ProjetTest extends TestCase
{
    public function testGettersAndSetters()
    {
        $projet = new Projet();

        // Test de l'ID (devrait être null avant persistance)
        $this->assertNull($projet->getId());

        // Test de l'intitulé
        $projet->setIntitule("Projet Symfony");
        $this->assertSame("Projet Symfony", $projet->getIntitule());

        // Test de la description
        $projet->setDescription("Un projet de développement Symfony.");
        $this->assertSame("Un projet de développement Symfony.", $projet->getDescription());

        // Test du nombre de places minimum et maximum
        $projet->setNbPlaceMin(3);
        $projet->setNbPlaceMax(5);
        $this->assertSame(3, $projet->getNbPlaceMin());
        $this->assertSame(5, $projet->getNbPlaceMax());

        // Test de __toString()
        $this->assertSame("Projet Symfony", (string)$projet);
    }

    public function testVoeuxManagement()
    {
        $projet = new Projet();
        $voeu = $this->createMock(Voeux::class);
        $voeu->method('getProjet')->willReturn($projet);

        // Test de l'ajout d'un voeu
        $projet->addVoeu($voeu);
        $this->assertInstanceOf(Collection::class, $projet->getVoeux());
        $this->assertCount(1, $projet->getVoeux());

        // Test de la suppression d'un voeu
        $projet->removeVoeu($voeu);
        $this->assertCount(0, $projet->getVoeux());
    }
}
