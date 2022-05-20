<?php

namespace App\Entity;

use App\Repository\ProjetRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ProjetRepository::class)
 */
class Projet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom_projet;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\OneToMany(targetEntity=declaration::class, mappedBy="projet")
     */
    private $declaration;

    /**
     * @ORM\ManyToOne(targetEntity=Equipe::class, inversedBy="projet")
     */
    private $equipe;

    public function __construct()
    {
        $this->declaration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNomProjet(): ?string
    {
        return $this->nom_projet;
    }

    public function setNomProjet(string $nom_projet): self
    {
        $this->nom_projet = $nom_projet;

        return $this;
    }

    public function getCreatedAt(): ?\DateTimeInterface
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeInterface $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    /**
     * @return Collection<int, declaration>
     */
    public function getDeclaration(): Collection
    {
        return $this->declaration;
    }

    public function addDeclaration(declaration $declaration): self
    {
        if (!$this->declaration->contains($declaration)) {
            $this->declaration[] = $declaration;
            $declaration->setProjet($this);
        }

        return $this;
    }

    public function removeDeclaration(declaration $declaration): self
    {
        if ($this->declaration->removeElement($declaration)) {
            // set the owning side to null (unless already changed)
            if ($declaration->getProjet() === $this) {
                $declaration->setProjet(null);
            }
        }

        return $this;
    }

    public function getEquipe(): ?Equipe
    {
        return $this->equipe;
    }

    public function setEquipe(?Equipe $equipe): self
    {
        $this->equipe = $equipe;

        return $this;
    }
}
