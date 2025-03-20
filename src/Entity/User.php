<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[ORM\Table(name: '`user`')]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    /**
     * @var string The hashed password
     */
    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $firstname = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $lastname = null;

    #[ORM\OneToMany(mappedBy: "user", targetEntity: Voeux::class, orphanRemoval: true)]
    private Collection $voeux;

    #[ORM\Column(type: Types::DATETIME_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $lastOnline = null;

    #[ORM\Column(type: Types::TEXT, nullable: true)]
    private ?string $biographie = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $username = null;

    /**
 * @var Collection<int, Friendship>
 */
#[ORM\OneToMany(targetEntity: Friendship::class, mappedBy: 'receiver')]
private Collection $receivedFriendRequests;

    /**
     * @var Collection<int, Friendship>
     */
    #[ORM\OneToMany(targetEntity: Friendship::class, mappedBy: 'requester')]
    private Collection $friendships;



    /**
     * @var Collection<int, Message>
     */
    #[ORM\OneToMany(targetEntity: Message::class, mappedBy: 'sendBy')]
    private Collection $messages;

    /**
     * @var Collection<int, Conversation>
     */
    #[ORM\OneToMany(targetEntity: Conversation::class, mappedBy: 'createdBy')]
    private Collection $conversations;

    /**
     * @var Collection<int, Conversation>
     */
    #[ORM\ManyToMany(targetEntity: Conversation::class, mappedBy: 'participants')]
    private Collection $conversationParticipants;

    public function __construct()
    {
        $this->roles = ['ROLE_USER'];
        $this->voeux = new ArrayCollection();
        $this->friendships = new ArrayCollection();
        $this->receiverFriendship = new ArrayCollection();
        $this->messages = new ArrayCollection();
        $this->conversations = new ArrayCollection();
        $this->conversationParticipants = new ArrayCollection();

    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // garantir que chaque utilisateur a au moins le rôle ROLE_USER
        $roles[] = 'ROLE_USER';
    
        return array_unique($roles);
    }

    public function setRoles(array $roles): static
    {
        if (!in_array('ROLE_USER', $roles)) {
            $roles[] = 'ROLE_USER';
        }
        $this->roles = $roles;
    
        return $this;
    }


    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getFirstname(): ?string
    {
        return $this->firstname;
    }

    public function setFirstname(?string $firstname): static
    {
        $this->firstname = $firstname;

        return $this;
    }

    public function getLastname(): ?string
    {
        return $this->lastname;
    }

    public function setLastname(?string $lastname): static
    {
        $this->lastname = $lastname;

        return $this;
    }
    /**
         * @see UserInterface
         */
       
        public function __toString(): string
        {
            return $this->firstname . " " . $this->lastname ; 
        }


    
        public function getVoeux(): Collection
        {
            return $this->voeux;
        }
    
        public function addVoeu(Voeux $voeu): static
        {
            if (!$this->voeux->contains($voeu)) {
                $this->voeux->add($voeu);
                $voeu->setUser($this);
            }
            return $this;
        }
    
        public function removeVoeu(Voeux $voeu): static
        {
            if ($this->voeux->removeElement($voeu)) {
                if ($voeu->getUser() === $this) {
                    $voeu->setUser(null);
                }
            }
            return $this;
        }

        public function getLastOnline(): ?\DateTimeInterface
        {
            return $this->lastOnline;
        }

        public function setLastOnline(?\DateTimeInterface $lastOnline): static
        {
            $this->lastOnline = $lastOnline;

            return $this;
        }

        public function getBiographie(): ?string
        {
            return $this->biographie;
        }

        public function setBiographie(?string $biographie): static
        {
            $this->biographie = $biographie;

            return $this;
        }

        public function getUsername(): ?string
        {
            return $this->username;
        }

        public function setUsername(?string $username): static
        {
            $this->username = $username;

            return $this;
        }

        /**
         * @return Collection<int, Friendship>
         */
        public function getFriendships(): Collection
        {
            return $this->friendships;
        }

        public function removeReceivedFriendRequest(Friendship $friendship): static
        {
            if ($this->receivedFriendRequests->removeElement($friendship)) {
                if ($friendship->getReceiver() === $this) {
                    $friendship->setReceiver(null);
                }
            }
            return $this;
        }
        

        public function getReceivedFriendRequests(): Collection
        {
            return $this->receivedFriendRequests;
        }
        public function addReceivedFriendRequest(Friendship $friendship): static
        {
            if (!$this->receivedFriendRequests->contains($friendship)) {
                $this->receivedFriendRequests->add($friendship);
                $friendship->setReceiver($this);
            }
            return $this;
        }
    

        /**
         * @return Collection<int, Message>
         */
        public function getMessages(): Collection
        {
            return $this->messages;
        }

        public function addMessage(Message $message): static
        {
            if (!$this->messages->contains($message)) {
                $this->messages->add($message);
                $message->setSendBy($this);
            }

            return $this;
        }

        public function removeMessage(Message $message): static
        {
            if ($this->messages->removeElement($message)) {
                // set the owning side to null (unless already changed)
                if ($message->getSendBy() === $this) {
                    $message->setSendBy(null);
                }
            }

            return $this;
        }

        /**
         * @return Collection<int, Conversation>
         */
        public function getConversations(): Collection
        {
            return $this->conversations;
        }

        public function addConversation(Conversation $conversation): static
        {
            if (!$this->conversations->contains($conversation)) {
                $this->conversations->add($conversation);
                $conversation->setCreatedBy($this);
            }

            return $this;
        }

        public function removeConversation(Conversation $conversation): static
        {
            if ($this->conversations->removeElement($conversation)) {
                // set the owning side to null (unless already changed)
                if ($conversation->getCreatedBy() === $this) {
                    $conversation->setCreatedBy(null);
                }
            }

            return $this;
        }

        /**
         * @return Collection<int, Conversation>
         */
        public function getConversationParticipants(): Collection
        {
            return $this->conversationParticipants;
        }

        public function addConversationParticipant(Conversation $conversationParticipant): static
        {
            if (!$this->conversationParticipants->contains($conversationParticipant)) {
                $this->conversationParticipants->add($conversationParticipant);
                $conversationParticipant->addParticipant($this);
            }

            return $this;
        }

        public function removeConversationParticipant(Conversation $conversationParticipant): static
        {
            if ($this->conversationParticipants->removeElement($conversationParticipant)) {
                $conversationParticipant->removeParticipant($this);
            }

            return $this;
        }

}
