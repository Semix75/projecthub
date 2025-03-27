<?php

namespace App\EventListener;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpKernel\Event\ExceptionEvent;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Authorization\AuthorizationCheckerInterface;
use Symfony\Component\HttpKernel\Exception\NotFoundHttpException;


class ExceptionListener
{
    private RouterInterface $router;
    private AuthorizationCheckerInterface $authChecker;
    private RequestStack $requestStack;

    public function __construct(
        RouterInterface $router,
        AuthorizationCheckerInterface $authChecker,
        RequestStack $requestStack,
    ) {
        $this->router = $router;
        $this->authChecker = $authChecker;
        $this->requestStack = $requestStack;
    }

    public function onKernelException(ExceptionEvent $event)
    {
        $exception = $event->getThrowable();
        $request = $this->requestStack->getCurrentRequest();

        // Éviter une boucle infinie de redirections
        $currentRoute = $request->attributes->get('_route');

        if ($exception instanceof NotFoundHttpException) {
            if ($currentRoute === 'app_error_404') {
                return;
            }

            // Option 1 : Redirection vers une page d'erreur 404
            $event->setResponse(new RedirectResponse($this->router->generate('app_error_404')));
            return;
        }

        if ($currentRoute === 'app_error_general') {
            return;
        }

        // Redirection vers la page d'erreur générale
        $event->setResponse(new RedirectResponse($this->router->generate('app_error_general')));
    }
}