<?php

namespace App\Service;

use App\Entity\User;
use App\Entity\Projet;
use App\Entity\Attribution;
use App\Entity\Voeux;
use Doctrine\ORM\EntityManagerInterface;

class VoeuxAttributionService
{
    private EntityManagerInterface $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    public function attribuerProjets(): void
    {
        $users = $this->entityManager->getRepository(User::class)->findAll();
        $users = array_filter($users, fn(User $u) => $u->getRoles() === ['ROLE_USER']);
        // foreach ($users as $user) {
        //     echo "Utilisateur : " . $user->getId() . " - " . $user->getusername() . " (" . implode(', ', $user->getRoles()) . ")\n";
        // }
        $projets = $this->entityManager->getRepository(Projet::class)->findAll();
        $voeux = $this->entityManager->getRepository(Voeux::class)->findAll();
        
        // On réorganise les voeux par utilisateur
        $voeuxParUser = [];
        foreach ($voeux as $voeu) {
            $userId = $voeu->getUser()->getId();
            $voeuxParUser[$userId][$voeu->getPriorite() - 1] = $voeu->getProjet()->getId();
        }
        
        // On prépare les élèves avec leurs voeux
        $eleves = [];
        foreach ($users as $user) {
            $id = $user->getId();
            $eleves[$id] = (object) [
                'entity' => $user,
                'voeux' => $voeuxParUser[$id] ?? [],
                'projet' => null
            ];
        }
        
        // On prépare les projets avec leurs contraintes
        $projetsMap = [];
        foreach ($projets as $projet) {
            $id = $projet->getId();
            $projetsMap[$id] = (object) [
                'entity' => $projet,
                'min' => $projet->getNbPlaceMin(),
                'max' => $projet->getNbPlaceMax(),
                'eleves' => []
            ];
        }
        // Phase 1 : Attribution initiale en respectant les vœux
        foreach ($eleves as $id => $eleve) {
            foreach ($eleve->voeux as $projetId) {
                if (count($projetsMap[$projetId]->eleves) < $projetsMap[$projetId]->max) {
                    $projetsMap[$projetId]->eleves[] = $id;
                    $eleve->projet = $projetId;
                    break;
                }
            }
        }
        // Phase 2 : Attribution des étudiants non-attribués à un projet disponible
        foreach ($eleves as $id => $eleve) {
            if ($eleve->projet === null) {
                foreach ($projetsMap as $projetId => $projet) {
                    if (count($projet->eleves) < $projet->max) {
                        $projet->eleves[] = $id;
                        $eleve->projet = $projetId;
                        break;
                    }
                }
            }
        }
        // Phase 3 : Rééquilibrage des projets sous-effectifs
        foreach ($projetsMap as $projetId => $projet) {
            if (count($projet->eleves) < $projet->min) {
                foreach ($projetsMap as $surProjetId => $surProjet) {
                    if ($projetId === $surProjetId) continue;

                    if (count($surProjet->eleves) > $surProjet->min) {
                        foreach ($surProjet->eleves as $key => $eleveId) {
                            if (in_array($projetId, $eleves[$eleveId]->voeux)) {
                                // Transfert
                                $projet->eleves[] = $eleveId;
                                unset($surProjet->eleves[$key]);
                                $projetsMap[$surProjetId]->eleves = array_values($surProjet->eleves); // réindexer
                                $eleves[$eleveId]->projet = $projetId;
                                break 2;
                            }
                        }
                    }
                }
            }
        }
        // Phase 4 : Réaffectation des étudiants des projets toujours sous-effectifs
        $elevesAReaffecter = [];

        foreach ($projetsMap as $projetId => $projet) {
            if (count($projet->eleves) < $projet->min) {
                foreach ($projet->eleves as $eleveId) {
                    $eleves[$eleveId]->projet = null;
                    $elevesAReaffecter[] = $eleveId;
                }
                $projet->eleves = [];
            }
        }

        // Réaffectation des étudiants libérés
        foreach ($elevesAReaffecter as $eleveId) {
            $reaffecte = false;

            // 1. Tenter via les vœux
            foreach ($eleves[$eleveId]->voeux as $voeuProjetId) {
                $p = $projetsMap[$voeuProjetId];
                if (
                    count($p->eleves) < $p->max &&
                    count($p->eleves) + 1 >= $p->min
                ) {
                    $p->eleves[] = $eleveId;
                    $eleves[$eleveId]->projet = $voeuProjetId;
                    $reaffecte = true;
                    break;
                }
            }

            // 2. Sinon, placement forcé dans un projet valide
            if (!$reaffecte) {
                foreach ($projetsMap as $projetId => $p) {
                    if (
                        count($p->eleves) < $p->max &&
                        count($p->eleves) + 1 >= $p->min
                    ) {
                        $p->eleves[] = $eleveId;
                        $eleves[$eleveId]->projet = $projetId;
                        break;
                    }
                }
            }
        }




        
        // Suppression des anciennes attributions
        $this->entityManager->createQuery('DELETE FROM App\Entity\Attribution')->execute();

        // Enregistrement des nouvelles attributions
        foreach ($eleves as $eleve) {
            if ($eleve->projet !== null) {
                $attribution = new Attribution();
                $attribution->setUser($eleve->entity);
                $attribution->setProjet($projetsMap[$eleve->projet]->entity);
                $this->entityManager->persist($attribution);
            }
        }

        $this->entityManager->flush();

    }
}