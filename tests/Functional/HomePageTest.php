<?php
// tests/Functional/HomePageTest.php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class HomePageTest extends WebTestCase
{
    public function testHomePageRedirectsToErreur(): void
    {
        $client = static::createClient();
        $client->request('GET', '/');
        
        // Vérifie que la réponse est une redirection vers "/erreur"
        $this->assertResponseRedirects('/erreur');
        
        // On suit la redirection et on vérifie que la page d'erreur contient le texte "Erreur"
        $crawler = $client->followRedirect();
        $this->assertStringContainsString('Erreur', $client->getResponse()->getContent());
    }
}
