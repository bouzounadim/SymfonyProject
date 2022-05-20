<?php

namespace App\Entity;

use App\Repository\DeclarationRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=DeclarationRepository::class)
 */
class Declaration
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $jours;

    /**
     * @ORM\Column(type="integer")
     */
    private $cumul;

    /**
     * @ORM\Column(type="integer")
     */
    private $temps;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="declaration")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Projet::class, inversedBy="declaration")
     */
    private $projet;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getJours(): ?int
    {
        return $this->jours;
    }

    public function setJours(int $jours): self
    {
        $this->jours = $jours;

        return $this;
    }

    public function getCumul(): ?int
    {
        return $this->cumul;
    }

    public function setCumul(int $cumul): self
    {
        $this->cumul = $cumul;

        return $this;
    }

    public function getTemps(): ?int
    {
        return $this->temps;
    }

    public function setTemps(int $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getProjet(): ?Projet
    {
        return $this->projet;
    }

    public function setProjet(?Projet $projet): self
    {
        $this->projet = $projet;

        return $this;
    }
}
