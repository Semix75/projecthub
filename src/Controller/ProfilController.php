<?php

namespace App\Controller;

use App\Entity\User;
use App\Form\ProfilType; 
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use App\Repository\VoeuxRepository;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(VoeuxRepository $voeuxRepository): Response
    {
        // Récupérer l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Si l'utilisateur n'est pas connecté, lever une exception d'accès refusé
        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour voir votre profil.");
        }

        // Récupérer les vœux de l'utilisateur, triés par priorité croissante
        $voeux = $voeuxRepository->findBy(
            ['user' => $user],
            ['priorite' => 'ASC']
        );

        // Rendre la vue du profil avec les données de l'utilisateur et ses vœux
        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'voeux' => $voeux,
        ]);
    }

    #[Route('/profil/edit', name: 'app_profil_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        /** @var User $user */
        // Récupérer l'utilisateur actuellement connecté
        $user = $this->getUser();

        // Si l'utilisateur n'est pas connecté, lever une exception d'accès refusé
        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour modifier votre profil.");
        }

        // Créer un formulaire pour modifier le profil de l'utilisateur
        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        // Vérifier si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Gérer le téléchargement de l'image de profil
            $profilePictureFile = $form->get('profilePicture')->getData();

            if ($profilePictureFile) {
                // Générer un nom de fichier unique et sécurisé pour l'image
                $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePictureFile->guessExtension();

                try {
                    // Déplacer le fichier téléchargé dans le répertoire configuré
                    $profilePictureFile->move(
                        $this->getParameter('profile_pictures_directory'),
                        $newFilename
                    );
                    // Mettre à jour le chemin de l'image de profil de l'utilisateur
                    $user->setProfilePicture($newFilename);
                } catch (FileException $e) {
                    // Ajouter un message flash en cas d'erreur lors du téléchargement
                    $this->addFlash('danger', 'Erreur lors du téléchargement de l’image.');
                }
            }

            // Sauvegarder les modifications dans la base de données
            $entityManager->persist($user);
            $entityManager->flush();

            // Ajouter un message flash de succès et rediriger vers la page du profil
            $this->addFlash('success', 'Votre profil a été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        // Rendre la vue pour modifier le profil avec le formulaire
        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
