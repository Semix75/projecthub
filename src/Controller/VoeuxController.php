<?php
namespace App\Controller;

use App\Entity\Voeux;
use App\Form\VoeuxType;
use App\Entity\Projet;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Exception\AccessDeniedException;

class VoeuxController extends AbstractController
{
    private $entityManager;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/voeux', name: 'app_voeux')]
    public function new(Request $request)
    {
        // Vérifier que l'utilisateur est connecté et possède le rôle "ROLE_USER"
        if (!$this->isGranted('ROLE_USER')) {
            throw new AccessDeniedException('Vous devez être connecté en tant qu\'utilisateur pour accéder à cette page.');
        }

        // Récupérer tous les projets depuis la base de données
        $projects = $this->entityManager->getRepository(Projet::class)->findAll();

        // Préparer les options pour les projets
        $choices = [];
        foreach ($projects as $project) {
            $choices[$project->getIntitule()] = $project->getId();
        }

        // Créer un objet Voeux pour l'étudiant
        $form = $this->createForm(VoeuxType::class, null, [
            'projets' => $choices, // Passer les projets au formulaire
        ]);

        // Traiter la soumission du formulaire
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Récupérer les données du formulaire
            $data = $form->getData();
            $user = $this->getUser();  // L'utilisateur connecté

            /*// Supprimer les anciens voeux de l'utilisateur avant d'enregistrer les nouveaux
            $this->entityManager->getRepository(Voeux::class)->deleteUserVoeux($user);  // Méthode à implémenter
*/
            // Sauvegarder chaque vœu dans la base de données avec la priorité correspondante
            for ($i = 1; $i <= 5; $i++) {
                $projetField = "projet_" . $i;
                $prioriteField = "priorite_" . $i;

                // Si l'utilisateur a choisi un projet pour cette priorité
                if (!empty($data[$projetField])) {
                    $voeux = new Voeux();
                    $voeux->setUser($user);
                    $voeux->setProjet($this->entityManager->getRepository(Projet::class)->find($data[$projetField]));
                    $voeux->setPriorite($data[$prioriteField]);

                    // Sauvegarder le vœu
                    $this->entityManager->persist($voeux);
                }
            }

            // Sauvegarder toutes les données en une seule fois
            $this->entityManager->flush();

            // Afficher un message de succès ou rediriger
            $this->addFlash('success', 'Vos vœux ont bien été enregistrés !');
            return $this->redirectToRoute('app_voeux'); // Redirige vers la même page (ou une autre page)
        }

        return $this->render('voeux/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
