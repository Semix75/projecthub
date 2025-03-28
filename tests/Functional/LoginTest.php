<?php
// tests/Functional/LoginTest.php

namespace App\Tests\Functional;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;

class LoginTest extends WebTestCase
{
    public function testUserCanLogin(): void
    {
        $client = static::createClient();
        $crawler = $client->request('GET', '/login');


        $form = $crawler->selectButton('Se connecter')->form();


        $form['email'] = 'testuser@example.com';
        $form['password'] = 'dummy';

        $client->submit($form);


        $this->assertResponseRedirects('/erreur');


        $crawler = $client->followRedirect();
        $this->assertStringContainsString('Erreur', $client->getResponse()->getContent());
    }
}
