<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

// Contrôleur pour gérer les erreurs
class ErrorController extends AbstractController
{
    // Route pour gérer les erreurs 404 (page non trouvée)
    #[Route('/erreur-404', name: 'app_error_404')]
    public function error404(): Response
    {
        // Rendu de la page d'erreur 404 avec un code de réponse HTTP 404
        return $this->render('errors/404.html.twig', [], new Response('', 404));
    }

    // Route pour gérer les erreurs générales (erreurs serveur)
    #[Route('/erreur', name: 'app_error_general')]
    public function generalError(): Response
    {
        // Rendu de la page d'erreur générale avec un code de réponse HTTP 500
        return $this->render('errors/general.html.twig', [], new Response('', 500));
    }
}
