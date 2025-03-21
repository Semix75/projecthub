<?php

namespace App\Controller;

use App\Repository\VoeuxRepository;
use App\Form\UserType;
use App\Entity\User;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;
use Doctrine\ORM\EntityManagerInterface;

class ProfilController extends AbstractController
{
    #[Route('/profil', name: 'app_profil')]
    public function index(
        Request $request, 
        VoeuxRepository $voeuxRepository, 
        SluggerInterface $slugger, 
        EntityManagerInterface $entityManager
    ): Response {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour voir votre profil.");
        }

        // Récupérer les vœux de l'utilisateur, triés par priorité
        $voeux = $voeuxRepository->findBy(
            ['user' => $user],
            ['priorite' => 'ASC']
        );

        // Création du formulaire pour la mise à jour du profil
        $form = $this->createForm(UserType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            // Gestion de l'image de profil
            $imageFile = $form->get('profilePicture')->getData();

            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $imageFile->guessExtension();

                try {
                    $imageFile->move(
                        $this->getParameter('profile_pictures_directory'), // Utilisation du paramètre défini dans services.yaml
                        $newFilename
                    );
                } catch (\Exception $e) {
                    $this->addFlash('error', 'Une erreur est survenue lors de l\'upload de l\'image.');
                }

                $user->setProfilePicture($newFilename);
            }

            // Sauvegarder les modifications dans la base de données
            $entityManager->flush(); 

            $this->addFlash('success', 'Votre profil a été mis à jour.');

            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/index.html.twig', [
            'form' => $form->createView(),
            'user' => $user,
            'voeux' => $voeux, 
        ]);
    }
}
