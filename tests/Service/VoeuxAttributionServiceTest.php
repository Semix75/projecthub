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
}
?>