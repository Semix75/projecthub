<?php

namespace App\DataFixtures;

use App\Entity\Friendship;
use App\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use Doctrine\Bundle\FixturesBundle\FixtureGroupInterface;

// lancer la fixture avec la commande suivante : php bin/console doctrine:fixtures:load --group=request --append
class requestFixtures extends Fixture implements FixtureGroupInterface{

    public static function getGroups(): array
    {
        return ['request'];
    }

    public function load(ObjectManager $manager): void
    {
        // Récupérer l'utilisateur "b"
        $b = $manager->getRepository(User::class)->findOneBy(['username' => 'b']);
        if (!$b) {
            throw new \Exception('Utilisateur "b" introuvable.');
        }
    
        // Récupérer tous les autres utilisateurs
        $users = $manager->getRepository(User::class)->findAll();
    
        foreach ($users as $user) {
            // Éviter que "b" soit le demandeur
            if ($user === $b) {
                continue;
            }
    
            // Créer une relation d'amitié
            $friendship = new Friendship();
            $friendship->setRequester($user); // L'utilisateur actuel est le demandeur
            $friendship->setReceiver($b); // "b" est toujours le destinataire
            $friendship->setStatus(Friendship::STATUS_PENDING);
    
            $manager->persist($friendship);
        }
    
        $manager->flush();
    }
}

