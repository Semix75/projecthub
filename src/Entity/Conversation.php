<?php

namespace App\Entity;

use ApiPlatform\Metadata\ApiResource;
use App\Repository\ConversationRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Doctrine\DBAL\Types\Types;


#[ORM\Entity(repositoryClass: ConversationRepository::class)]
#[ApiResource(
    normalizationContext: ['groups' => ['conversation:read']],
    denormalizationContext: ['groups' => ['conversation:write']]
)]
class Conversation
{
    #[Groups(['conversation:read'])]
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    

    #[ORM\Column( length: 255, nullable: true)]
    #[Groups(['conversation:read', 'conversation:write'])]
    private ?string $title = null;
    

    #[ORM\Column( type: Types::DATETIME_IMMUTABLE,nullable: true)]
    #[Groups(['conversation:read'])]
    private ?\DateTimeImmutable $createdAt = null;
    

    #[ORM\ManyToOne(targetEntity: User::class)]
    #[Groups(['conversation:read'])]
    private ?User $createdBy = null;
    
    #[ORM\ManyToMany(targetEntity: User::class)]
    #[Groups(['conversation:read', 'conversation:write'])]
    private Collection $participants;


    public function __construct()
    {
        $this->participants = new ArrayCollection();
        $this->createdAt = new \DateTimeImmutable();
        $this->messages = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(?string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?\DateTimeImmutable $createdAt): static
    {
        $this->createdAt = $createdAt;

        return $this;
    }

    public function getCreatedBy(): ?User
    {
        return $this->createdBy;
    }

    public function setCreatedBy(?User $createdBy): static
    {
        $this->createdBy = $createdBy;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getParticipants(): Collection
    {
        return $this->participants;
    }

    public function addParticipant(User $participant): static
    {
        if (!$this->participants->contains($participant)) {
            $this->participants->add($participant);
        }

        return $this;
    }

    public function removeParticipant(User $participant): static
    {
        $this->participants->removeElement($participant);

        return $this;
    }
}
