<?php
// tests/Integration/HomePageControllerTest.php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageControllerTest extends WebTestCase
{
    public function testHomePageRedirectsToErreur(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');

        // Vérifie que la réponse est une redirection vers "/erreur"
        $this->assertResponseRedirects('/erreur');

        // On peut suivre la redirection et vérifier le contenu de la page d'erreur
        $crawler = $client->followRedirect();
        $this->assertStringContainsString('Erreur', $client->getResponse()->getContent());
    }
}
