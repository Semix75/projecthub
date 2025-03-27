<?php
namespace App\EventSubscriber;

use Psr\Log\LoggerInterface;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use Symfony\Component\Security\Http\Event\InteractiveLoginEvent;
use Symfony\Component\HttpKernel\Event\RequestEvent;
use Symfony\Component\HttpFoundation\RequestStack;

class UserActivitySubscriber implements EventSubscriberInterface
{
    private LoggerInterface $logger;
    private RequestStack $requestStack;

    public function __construct(LoggerInterface $logger, RequestStack $requestStack)
    {
        $this->logger = $logger;
        $this->requestStack = $requestStack;
    }

    public static function getSubscribedEvents(): array
    {
        return [
            InteractiveLoginEvent::class => 'onUserLogin',
            RequestEvent::class => 'onPageVisit',
        ];
    }

    public function onUserLogin(InteractiveLoginEvent $event): void
    {
        $user = $event->getAuthenticationToken()->getUser();
        $this->logger->info("Utilisateur connecté: " . $user->getUserIdentifier(), ['channel' => 'user_activity']);
    }

    public function onPageVisit(RequestEvent $event): void
    {
        $request = $event->getRequest();
        if (!$request->isXmlHttpRequest()) { // Filtrer les requêtes AJAX
            $this->logger->info("Visite de page: " . $request->getRequestUri(), ['channel' => 'user_activity']);
        }
    }
}
