<?php
// tests/Integration/LoginIntegrationTest.php

namespace App\Tests\Integration;

use Symfony\Bundle\FrameworkBundle\Test\WebTestCase;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Tools\SchemaTool;
use App\Entity\User;

class LoginIntegrationTest extends WebTestCase
{
    private $client;
    private $entityManager;
    
    protected function setUp(): void
    {
        // Crée le client (ce qui boot le kernel automatiquement)
        $this->client = static::createClient();
        
        // Récupère l'EntityManager depuis le container
        $this->entityManager = static::getContainer()->get(EntityManagerInterface::class);
        
        // Recrée le schéma de la base de données pour l'environnement de test
        $schemaTool = new SchemaTool($this->entityManager);
        $metadata = $this->entityManager->getMetadataFactory()->getAllMetadata();
        if (!empty($metadata)) {
            $schemaTool->dropSchema($metadata);
            $schemaTool->createSchema($metadata);
        }
        
        // Crée un utilisateur de test s'il n'existe pas déjà
        if (!$this->entityManager->getRepository(User::class)->findOneBy(['email' => 'testuser@example.com'])) {
            $testUser = new User();
            // Adaptez ces setters selon votre entité User
            $testUser->setUsername('testuser');
            $testUser->setEmail('testuser@example.com');
            $testUser->setPassword('dummy'); // Assure que le champ password est rempli
            $this->entityManager->persist($testUser);
            $this->entityManager->flush();
        }
    }
    
    public function testLoginIntegration(): void
    {
        // Récupère l'utilisateur de test
        $user = $this->entityManager->getRepository(User::class)->findOneBy(['email' => 'testuser@example.com']);
        $this->assertNotNull($user, 'Test user not found.');
        
        // Simule la connexion de l'utilisateur
        $this->client->loginUser($user);
        
        // Accède à une page protégée (ici /profil)
        $this->client->request('GET', '/profil');
        $this->assertResponseIsSuccessful();
        
        // Vérifie que le contenu de la page contient un élément indiquant la connexion (ex: "Mon Profil")
        $this->assertStringContainsString('Mon Profil', $this->client->getResponse()->getContent());
    }
    
    protected function tearDown(): void
    {
        parent::tearDown();
        if ($this->entityManager) {
            $this->entityManager->close();
            $this->entityManager = null;
        }
    }
}
