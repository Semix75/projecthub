<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ErrorController extends AbstractController
{
    #[Route('/erreur-404', name: 'app_error_404')]
    public function error404(): Response
    {
        return $this->render('errors/404.html.twig', [], new Response('', 404));
    }

    #[Route('/erreur', name: 'app_error_general')]
    public function generalError(): Response
    {
        return $this->render('errors/general.html.twig', [], new Response('', 500));
    }
}
