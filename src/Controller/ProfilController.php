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
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour voir votre profil.");
        }

        // Récupérer les vœux de l'utilisateur, triés par priorité
        $voeux = $voeuxRepository->findBy(
            ['user' => $user],
            ['priorite' => 'ASC']
        );

        return $this->render('profil/index.html.twig', [
            'user' => $user,
            'voeux' => $voeux,
        ]);
    }

    #[Route('/profil/edit', name: 'app_profil_edit')]
    public function edit(Request $request, EntityManagerInterface $entityManager, SluggerInterface $slugger): Response
    {
        /** @var User $user */
        $user = $this->getUser();

        if (!$user) {
            throw $this->createAccessDeniedException("Vous devez être connecté pour modifier votre profil.");
        }

        $form = $this->createForm(ProfilType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profilePictureFile = $form->get('profilePicture')->getData();

            if ($profilePictureFile) {
                $originalFilename = pathinfo($profilePictureFile->getClientOriginalName(), PATHINFO_FILENAME);
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename . '-' . uniqid() . '.' . $profilePictureFile->guessExtension();

                try {
                    $profilePictureFile->move(
                        $this->getParameter('profile_pictures_directory'),
                        $newFilename
                    );
                    $user->setProfilePicture($newFilename);
                } catch (FileException $e) {
                    $this->addFlash('danger', 'Erreur lors du téléchargement de l’image.');
                }
            }

            $entityManager->persist($user);
            $entityManager->flush();

            $this->addFlash('success', 'Votre profil a été mis à jour.');
            return $this->redirectToRoute('app_profil');
        }

        return $this->render('profil/edit.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
