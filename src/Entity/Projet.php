<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: ProjetRepository::class)]
class Projet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $intitule = null;

    #[ORM\Column(length: 255, nullable: true)]
    private ?string $description = null;

    #[ORM\OneToMany(mappedBy: "projet", targetEntity: Voeux::class, orphanRemoval: true)]
    private Collection $voeux;

    #[ORM\Column(nullable: true)]
    private ?int $nbPlaceMin = null;

    #[ORM\Column(nullable: true)]
    private ?int $nbPlaceMax = null;

    public function __construct()
    {
        $this->voeux = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(?string $intitule): static
    {
        $this->intitule = $intitule;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): static
    {
        $this->description = $description;

        return $this;
    }

    public function getVoeux(): Collection
    {
        return $this->voeux;
    }

    public function addVoeu(Voeux $voeu): static
    {
        if (!$this->voeux->contains($voeu)) {
            $this->voeux->add($voeu);
            $voeu->setProjet($this);
        }
        return $this;
    }

    public function removeVoeu(Voeux $voeu): static
    {
        if ($this->voeux->removeElement($voeu)) {
            if ($voeu->getProjet() === $this) {
                $voeu->setProjet(null);
            }
        }
        return $this;
    } 


    public function __toString(): string
    {
        return $this->intitule ?? '';
    }

    public function getNbPlaceMin(): ?int
    {
        return $this->nbPlaceMin;
    }

    public function setNbPlaceMin(?int $nbPlaceMin): static
    {
        $this->nbPlaceMin = $nbPlaceMin;

        return $this;
    }

    public function getNbPlaceMax(): ?int
    {
        return $this->nbPlaceMax;
    }

    public function setNbPlaceMax(?int $nbPlaceMax): static
    {
        $this->nbPlaceMax = $nbPlaceMax;

        return $this;
    }
}
