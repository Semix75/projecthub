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

        $projets = $this->entityManager->getRepository(Projet::class)->findAll();
        $voeux = $this->entityManager->getRepository(Voeux::class)->findAll();

        // Organiser les voeux par utilisateur
        $voeuxParUser = [];
        foreach ($voeux as $voeu) {
            $userId = $voeu->getUser()->getId();
            $voeuxParUser[$userId][$voeu->getPriorite() - 1] = $voeu->getProjet()->getId();
        }

        // Élèves : [id => (object avec entity, voeux, projet)]
        $eleves = [];
        foreach ($users as $user) {
            $id = $user->getId();
            $eleves[$id] = (object)[
                'entity' => $user,
                'voeux' => $voeuxParUser[$id] ?? [],
                'projet' => null
            ];
        }

        // Projets : [id => (object avec entity, min, max, eleves)]
        $projetsMap = [];
        foreach ($projets as $projet) {
            $id = $projet->getId();
            $projetsMap[$id] = (object)[
                'entity' => $projet,
                'min' => $projet->getNbPlaceMin(),
                'max' => $projet->getNbPlaceMax(),
                'eleves' => []
            ];
        }

        // === PHASE 1 : Attribution initiale en fonction des vœux ===
        foreach ($eleves as $id => $eleve) {
            foreach ($eleve->voeux as $projetId) {
                if ($this->peutAccueillir($projetsMap[$projetId])) {
                    $this->affecterProjet($projetsMap, $eleves, $id, $projetId);
                    break;
                }
            }
        }

        // === PHASE 2 : Affectation forcée si élève non attribué ===
        foreach ($eleves as $id => $eleve) {
            if ($eleve->projet === null) {
                $affecte = false;

                foreach ($projetsMap as $projetId => $projet) {
                    if ($this->estSousEffectif($projet) && $this->peutAccueillir($projet)) {
                        $this->affecterProjet($projetsMap, $eleves, $id, $projetId);
                        $affecte = true;
                        break;
                    }
                }

                if (!$affecte) {
                    foreach ($projetsMap as $projetId => $projet) {
                        if ($this->peutAccueillir($projet)) {
                            $this->affecterProjet($projetsMap, $eleves, $id, $projetId);
                            break;
                        }
                    }
                }
            }
        }

        // === PHASE 3 : Transfert ciblé vers projets sous-effectifs ===
        foreach ($projetsMap as $projetId => $projet) {
            if ($this->estSousEffectif($projet)) {
                foreach ($projetsMap as $srcId => $srcProjet) {
                    if ($projetId === $srcId || count($srcProjet->eleves) <= $srcProjet->min) continue;
                    foreach ($srcProjet->eleves as $key => $eleveId) {
                        if (in_array($projetId, $eleves[$eleveId]->voeux)) {
                            unset($srcProjet->eleves[$key]);
                            $srcProjet->eleves = array_values($srcProjet->eleves);
                            $this->affecterProjet($projetsMap, $eleves, $eleveId, $projetId);
                            break 2;
                        }
                    }
                }
            }
        }

        // === PHASE 4 : Suppression des projets invalides et réaffectation ===
        $elevesAReaffecter = [];
        foreach ($projetsMap as $projetId => $projet) {
            if ($this->estSousEffectif($projet)) {
                foreach ($projet->eleves as $eleveId) {
                    $eleves[$eleveId]->projet = null;
                    $elevesAReaffecter[] = $eleveId;
                }
                $projet->eleves = [];
            }
        }

        foreach ($elevesAReaffecter as $eleveId) {
            $reaffecte = false;
            foreach ($eleves[$eleveId]->voeux as $voeuProjetId) {
                $p = $projetsMap[$voeuProjetId];
                if ($this->peutAccueillir($p) && (count($p->eleves) + 1 >= $p->min)) {
                    $this->affecterProjet($projetsMap, $eleves, $eleveId, $voeuProjetId);
                    $reaffecte = true;
                    break;
                }
            }
            if (!$reaffecte) {
                foreach ($projetsMap as $projetId => $p) {
                    if ($this->peutAccueillir($p) && (count($p->eleves) + 1 >= $p->min)) {
                        $this->affecterProjet($projetsMap, $eleves, $eleveId, $projetId);
                        break;
                    }
                }
            }
        }

        // === PHASE 4 BIS : Regroupement forcé avec déplacements ===
        $nonAffectes = array_filter($eleves, fn($e) => $e->projet === null);
        $nbNonAffectes = count($nonAffectes);

        if ($nbNonAffectes > 0) {
            $meilleurProjetId = null;
            $meilleurCout = PHP_INT_MAX;
            $meilleursDeplacables = [];

            foreach ($projetsMap as $id => $projet) {
                if (count($projet->eleves) > 0) continue;

                $nbManquants = max(0, $projet->min - $nbNonAffectes);
                if ($nbNonAffectes + $nbManquants > $projet->max) continue;

                $deplacables = [];
                foreach ($eleves as $eid => $e) {
                    if ($e->projet !== null && $e->projet !== $id) {
                        $rang = array_search($e->projet, $e->voeux);
                        if ($rang === false || $rang >= 3) {
                            $deplacables[] = $eid;
                            if (count($deplacables) === $nbManquants) break;
                        }
                    }
                }

                if (count($deplacables) === $nbManquants && $nbManquants < $meilleurCout) {
                    $meilleurProjetId = $id;
                    $meilleurCout = $nbManquants;
                    $meilleursDeplacables = $deplacables;
                }
            }

            if ($meilleurProjetId !== null) {
                foreach ($meilleursDeplacables as $eid) {
                    $ancien = $eleves[$eid]->projet;
                    $projetsMap[$ancien]->eleves = array_values(array_filter($projetsMap[$ancien]->eleves, fn($v) => $v !== $eid));
                    $this->affecterProjet($projetsMap, $eleves, $eid, $meilleurProjetId);
                }

                foreach ($nonAffectes as $e) {
                    $eid = $e->entity->getId();
                    $this->affecterProjet($projetsMap, $eleves, $eid, $meilleurProjetId);
                }
            }
        }

        // === PERSISTANCE DES ATTRIBUTIONS ===
        $this->entityManager->createQuery('DELETE FROM App\Entity\Attribution')->execute();

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

    // === Méthodes privées utilitaires ===

    private function peutAccueillir(object $projet): bool
    {
        return count($projet->eleves) < $projet->max;
    }

    private function estSousEffectif(object $projet): bool
    {
        return count($projet->eleves) < $projet->min;
    }

    private function affecterProjet(array &$projets, array &$eleves, int $eleveId, int $projetId): void
    {
        $projets[$projetId]->eleves[] = $eleveId;
        $eleves[$eleveId]->projet = $projetId;
    }
}
?>