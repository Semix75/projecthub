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

        // Récupérer les amitiés où l'utilisateur est impliqué (requester ou receiver)
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
    #[Route('/friends/remove/{userId}', name: 'app_remove_friend', methods: ['POST'])]
    public function removeFriend(Security $security, int $userId, EntityManagerInterface $entityManager, FriendshipRepository $friendshipRepository): Response
    {
        $user = $this->getUser();
        $friend = $entityManager->getRepository(User::class)->find($userId);
    
        if (!$friend) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }
    
        // Trouver l'amitié existante
        $friendship = $friendshipRepository->findOneBy([
            'requester' => $user,
            'receiver' => $friend
        ]) ?? $friendshipRepository->findOneBy([
            'requester' => $friend,
            'receiver' => $user
        ]);
    
        if (!$friendship) {
            throw $this->createNotFoundException("Aucune relation d'amitié trouvée.");
        }
    
        // Supprimer uniquement la relation d'amitié
        $entityManager->remove($friendship);
        $entityManager->flush();
    
        $this->addFlash('success', 'Amitié supprimée avec succès.');
        return $this->redirectToRoute('app_friends_list');
    }
    

    #[Route('/friends/block/{userId}', name: 'app_block_friend', methods: ['POST'])]
    public function blockFriend(Security $security, int $userId, EntityManagerInterface $entityManager, FriendshipRepository $friendshipRepository): Response
    {
        $user = $this->getUser();
        $friend = $entityManager->getRepository(User::class)->find($userId);
    
        if (!$friend) {
            throw $this->createNotFoundException("Utilisateur non trouvé.");
        }
    
        // Trouver l'amitié existante entre les deux utilisateurs
        $friendship = $friendshipRepository->findOneBy([
            'requester' => $user,
            'receiver' => $friend
        ]) ?? $friendshipRepository->findOneBy([
            'requester' => $friend,
            'receiver' => $user
        ]);
    
        if (!$friendship) {
            throw $this->createNotFoundException("Aucune relation d'amitié trouvée.");
        }
    
        // Modifier le statut à "blocked" et enregistrer qui a bloqué
        $friendship->setStatus(Friendship::STATUS_BLOCKED);
        $friendship->setBlockedBy($user->getId()); // ✅ Enregistre bien l'ID de l'utilisateur
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


    #[Route('/profile/{id}', name: 'app_user_profile')]
    public function userProfile(User $user, FriendshipRepository $friendshipRepository, Security $security): Response
    {
        $currentUser = $security->getUser();
    
        $friendship = $friendshipRepository->findOneBy([
            'requester' => $currentUser,
            'receiver' => $user
        ]) ?? $friendshipRepository->findOneBy([
            'requester' => $user,
            'receiver' => $currentUser
        ]);
    
        $isFriend = $friendship && $friendship->getStatus() === Friendship::STATUS_ACCEPTED;
        $pendingRequest = $friendship && $friendship->getStatus() === Friendship::STATUS_PENDING && $friendship->getRequester() === $currentUser;
        $receivedRequest = $friendship && $friendship->getStatus() === Friendship::STATUS_PENDING && $friendship->getReceiver() === $currentUser;
    
        return $this->render('friendship/profil.html.twig', [
            'user' => $user,
            'isFriend' => $isFriend,
            'pendingRequest' => $pendingRequest,
            'receivedRequest' => $receivedRequest,
        ]);
    }
    



}
