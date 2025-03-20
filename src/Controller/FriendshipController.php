<?php

namespace App\Controller;

use App\Entity\Friendship;
use App\Entity\User;
use App\Repository\FriendshipRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\ArgumentResolver\EntityValueResolver;

class FriendshipController extends AbstractController
{
    #[Route('/friends', name: 'app_friends_list')]
    public function listFriends(Security $security, FriendshipRepository $friendshipRepository): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();


        // Récupérer les amitiés où le user est requester ou receiver
        $friends = $friendshipRepository->createQueryBuilder('f')
            ->where('f.requester = :user OR f.receiver = :user')
            ->andWhere('f.status = :status')
            ->setParameter('user', $user)
            ->setParameter('status', Friendship::STATUS_ACCEPTED)
            ->getQuery()
            ->getResult();

        return $this->render('friendship/list.html.twig', [
            'friends' => $friends,
        ]);
    }



    #[Route('/friend-requests', name: 'app_friend_requests')]
    public function listFriendRequests(Security $security, FriendshipRepository $friendshipRepository): Response
    {

        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();
        $requests = $friendshipRepository->findBy([
            'status' => Friendship::STATUS_PENDING,
            'receiver' => $user
        ]);

        return $this->render('friendship/requests.html.twig', [
            'requests' => $requests,
        ]);
    }


    #[Route('/friend-requests/accept/{id}', name: 'app_accept_friend', methods: ['POST', 'GET'])]
    public function acceptFriendRequest(Security $security, Friendship $friendship, EntityManagerInterface $entityManager): Response
    {

        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur connecté est bien le destinataire de la demande
        if ($friendship->getReceiver() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas accepter cette demande.");
        }

        // Modifier le statut à "accepted"
        $friendship->setStatus(Friendship::STATUS_ACCEPTED);
        $friendship->setFriendAt(new \DateTime());
        $entityManager->persist($friendship);
        $entityManager->flush();

        $this->addFlash('success', "demande d'ami accepter avec succès.");
        // Rediriger vers la liste des demandes d'amis après acceptation
        return $this->redirectToRoute('app_friend_requests');
    }

    #[Route('/friends/remove/{id}', name: 'app_remove_friend', methods: ['POST'])]
    public function removeFriend(Security $security, Friendship $friendship, EntityManagerInterface $entityManager): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        $user = $this->getUser();

        // Vérifier si l'utilisateur est impliqué dans l'amitié
        if ($friendship->getRequester() !== $user && $friendship->getReceiver() !== $user) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas supprimer cette amitié.");
        }

        $entityManager->remove($friendship);
        $entityManager->flush();

        $this->addFlash('success', 'Ami supprimé avec succès.');
        return $this->redirectToRoute('app_friends_list');
    }

    #[Route('/friends/block/{id}', name: 'app_block_friend', methods: ['POST'])]
    public function blockFriend(Security $security, Friendship $friendship, EntityManagerInterface $entityManager): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }
    
        $user = $this->getUser();
    
        // Vérifier si l'utilisateur est impliqué dans l'amitié
        if ($friendship->getRequester() !== $user && $friendship->getReceiver() !== $user) {
            $this->addFlash('error', 'Vous ne pouvez pas bloquer cet utilisateur.');
            return $this->redirectToRoute('app_friends_list');
        }
    
        $friendship->setStatus(Friendship::STATUS_BLOCKED);
        $friendship->setBlockedBy($user->getId()); // On enregistre qui a bloqué
    
        $entityManager->flush();
    
        $this->addFlash('success', 'Utilisateur bloqué avec succès.');
        return $this->redirectToRoute('app_friends_list');
    }
    

    #[Route('/friends/blocked', name: 'app_list_block_friend', methods: ['GET'])]
    public function listBlockedFriends(Security $security, FriendshipRepository $friendshipRepository): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }
    
        $user = $this->getUser();
    
        // Récupérer les utilisateurs que j'ai bloqués
        $blockedByMe = $friendshipRepository->createQueryBuilder('f')
            ->where('f.blockedBy = :user')
            ->setParameter('user', $user->getId())
            ->getQuery()
            ->getResult();
    
        // Récupérer les utilisateurs qui m'ont bloqué
        $blockedMe = $friendshipRepository->createQueryBuilder('f')
            ->where('f.status = :status')
            ->andWhere('f.blockedBy IS NOT NULL')
            ->andWhere('f.blockedBy != :user') // Filtrer ceux qui m'ont bloqué
            ->setParameter('status', Friendship::STATUS_BLOCKED)
            ->setParameter('user', $user->getId())
            ->getQuery()
            ->getResult();
    
        return $this->render('friendship/blocked.html.twig', [
            'blockedByMe' => $blockedByMe,
            'blockedMe' => $blockedMe,
        ]);
    }
    
    
    
    #[Route('/friends/unblock/{id}', name: 'app_unblock_friend', methods: ['POST'])]
    public function unblockFriend(Security $security, Friendship $friendship, EntityManagerInterface $entityManager): Response
    {
        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }
    
        $user = $this->getUser();
    
        // Vérifier que c'est bien le user connecté qui avait bloqué l'autre
        if ($friendship->getBlockedBy() !== $user->getId()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas débloquer cet utilisateur.");
        }
    
        // Vérifier si c'était un ami avant d'être bloqué
        if ($friendship->getStatus() === Friendship::STATUS_BLOCKED) {
            $friendship->setStatus(Friendship::STATUS_ACCEPTED);
        }
    
        $friendship->setBlockedBy(null); // Supprimer l'information du blocage
        $entityManager->flush();
    
        $this->addFlash('success', 'Utilisateur débloqué avec succès.');
        return $this->redirectToRoute('app_list_block_friend');
    }
    

    #[Route('/friend-requests/decline/{id}', name: 'app_decline_friend', methods: ['POST', 'GET'])]
    public function declineFriendRequest(Security $security, Friendship $friendship, EntityManagerInterface $entityManager): Response
    {

        if (!$security->isGranted('IS_AUTHENTICATED_FULLY')) {
            return $this->redirectToRoute('app_login');
        }

        // Vérifier que l'utilisateur connecté est bien le destinataire de la demande
        if ($friendship->getReceiver() !== $this->getUser()) {
            throw $this->createAccessDeniedException("Vous ne pouvez pas refuser cette demande.");
        }

        // Supprimer la demande d'ami
        $entityManager->remove($friendship);
        $entityManager->flush();

        $this->addFlash('success', "demande d'ami refuser avec succès.");
        // Rediriger vers la liste des demandes d'amis après suppression
        return $this->redirectToRoute('app_friend_requests');
    }


    #[Route('/friends/add', name: 'app_add_friend', methods: ['GET', 'POST'])]
    public function addFriend(Request $request, EntityManagerInterface $entityManager): Response
    {
        $user = $this->getUser();
        $error = null;

        if ($request->isMethod('POST')) {
            $friendIdentifier = $request->request->get('friend_identifier');

            // Vérifier si l'input correspond à un email ou un pseudo
            $friend = $entityManager->getRepository(User::class)->findOneBy([
                'email' => $friendIdentifier
            ]) ?? $entityManager->getRepository(User::class)->findOneBy([
                            'username' => $friendIdentifier
                        ]);

            if (!$friend) {
                $error = "Utilisateur non trouvé.";
            } elseif ($friend === $user) {
                $error = "Vous ne pouvez pas vous ajouter vous-même.";
            } else {
                // Vérifier si une demande existe déjà
                $waitFriendship = $entityManager->getRepository(Friendship::class)->findOneBy([
                    'requester' => $user,
                    'receiver' => $friend,
                    'status' => Friendship::STATUS_PENDING
                ]);

                $existingFriendship = $entityManager->getRepository(Friendship::class)->findOneBy([
                    'requester' => $user,
                    'receiver' => $friend,
                    'status' => Friendship::STATUS_ACCEPTED
                ]);

                if ($waitFriendship) {
                    $error = "Une demande d'ami est déjà en attente.";
                } elseif ($existingFriendship) {
                    $error = "Vous êtes déjà amis.";
                } else {
                    // Créer une nouvelle demande d'ami
                    $friendship = new Friendship();
                    $friendship->setRequester($user);
                    $friendship->setReceiver($friend);
                    $friendship->setStatus(Friendship::STATUS_PENDING);
                    $friendship->setCreatedAt(new \DateTime());

                    $entityManager->persist($friendship);
                    $entityManager->flush();

                    $this->addFlash('success', 'Demande d\'ami envoyée avec succès !');
                    return $this->redirectToRoute('app_friends_list');
                }
            }
        }

        return $this->render('friendship/add.html.twig', [
            'error' => $error,
        ]);
    }



}
