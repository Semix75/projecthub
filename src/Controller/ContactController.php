<?php

namespace App\Controller;

use App\Form\ContactType;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;

class ContactController extends AbstractController
{
    #[Route('/contact', name: 'app_contact')]
    public function index(Request $request, MailerInterface $mailer): Response
    {
        // Création du formulaire de contact
        $form = $this->createForm(ContactType::class);
        $form->handleRequest($request);

        // Vérifie si le formulaire a été soumis et est valide
        if ($form->isSubmitted() && $form->isValid()) {
            // Récupération des données du formulaire
            $data = $form->getData();

            // Création de l'email avec les données du formulaire
            $email = (new TemplatedEmail())
                ->from(new Address($data['email'], $data['name'])) // Adresse de l'expéditeur
                ->to('projecthub.contact@gmail.com') // Adresse du destinataire
                ->subject('Nouveau message de contact') // Sujet de l'email
                ->htmlTemplate('emails/contact.html.twig') // Template HTML de l'email
                ->context([
                    'name' => $data['name'], // Nom de l'expéditeur
                    'user_email' => $data['email'], // Email de l'expéditeur
                    'message' => $data['message'], // Message de l'expéditeur
                ]);

            try {
                // Envoi de l'email
                $mailer->send($email);
                // Ajout d'un message flash de succès
                $this->addFlash('success', 'Votre message a été envoyé avec succès.');

                // Redirection de l'utilisateur après l'envoi pour éviter le renvoi du formulaire en cas d'actualisation
                return $this->redirectToRoute('app_contact');
            } catch (\Exception $e) {
                // Ajout d'un message flash en cas d'erreur lors de l'envoi de l'email
                $this->addFlash('error', 'Erreur lors de l’envoi du mail : ' . $e->getMessage());
            }
        }

        // Affichage de la page de contact avec le formulaire
        return $this->render('contact/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
