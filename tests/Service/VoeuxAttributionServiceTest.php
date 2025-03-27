<?php

namespace App\Tests\Service;

use App\Entity\Attribution;
use App\Service\VoeuxAttributionService;
use App\Tests\Fixtures\AttributionFixtures;
use Symfony\Bundle\FrameworkBundle\Test\KernelTestCase;
use Liip\TestFixturesBundle\Services\DatabaseToolCollection;

class VoeuxAttributionServiceTest extends KernelTestCase
{
    private VoeuxAttributionService $service;

    protected function setUp(): void
    {
        self::bootKernel();
        $this->service = static::getContainer()->get(VoeuxAttributionService::class);

        // ✅ Utilisation du DatabaseToolCollection pour charger les fixtures
        $databaseTool = static::getContainer()->get(DatabaseToolCollection::class)->get();
        $databaseTool->loadFixtures([
            AttributionFixtures::class,
        ]);
    }

    public function testServiceCreeDesAttributions(): void
    {
        // Exécution du service
        $this->service->attribuerProjets();

        // Récupérer les attributions générées
        $em = static::getContainer()->get('doctrine')->getManager();
        $attributions = $em->getRepository(Attribution::class)->findAll();

        // Vérifier que des attributions ont bien été créées
        $this->assertNotEmpty($attributions, 'Le service devrait créer des attributions');
    }
    public function testAucunEleveNonAffecte(): void
    {
        $this->service->attribuerProjets();

        $em = static::getContainer()->get('doctrine')->getManager();

        // Récupérer tous les utilisateurs avec le rôle "ROLE_USER"
        $users = array_filter(
            $em->getRepository(\App\Entity\User::class)->findAll(),
            fn($user) => $user->getRoles() === ['ROLE_USER']
        );

        $attributions = $em->getRepository(Attribution::class)->findAll();
        $userAffectes = array_map(fn($a) => $a->getUser()->getId(), $attributions);

        foreach ($users as $user) {
            $this->assertContains(
                $user->getId(),
                $userAffectes,
                "L'utilisateur {$user->getUsername()} n'a pas été affecté à un projet"
            );
        }
    }
}
?>