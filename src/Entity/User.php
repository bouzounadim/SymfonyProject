<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User
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
    private $matricule;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $autorisation;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $option_verouillage;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $possibilite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $cir;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $mission;

    /**
     * @ORM\Column(type="datetime")
     */
    private $created_at;

    /**
     * @ORM\Column(type="array")
     */
    private $roles = [];

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="salaries")
     */
    private $chef;

    /**
     * @ORM\OneToMany(targetEntity=User::class, mappedBy="chef")
     */
    private $salaries;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chefs")
     */
    private $drd1;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="chefs2")
     */
    private $drd2;

    /**
     * @ORM\ManyToMany(targetEntity=Equipe::class, inversedBy="users")
     */
    private $equipe;

    /**
     * @ORM\OneToMany(targetEntity=declaration::class, mappedBy="user")
     */
    private $declaration;

    public function __construct()
    {
        $this->salaries = new ArrayCollection();
        $this->equipe = new ArrayCollection();
        $this->declaration = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMatricule(): ?string
    {
        return $this->matricule;
    }

    public function setMatricule(string $matricule): self
    {
        $this->matricule = $matricule;

        return $this;
    }

    public function getAutorisation(): ?string
    {
        return $this->autorisation;
    }

    public function setAutorisation(?string $autorisation): self
    {
        $this->autorisation = $autorisation;

        return $this;
    }

    public function getOptionVerouillage(): ?string
    {
        return $this->option_verouillage;
    }

    public function setOptionVerouillage(?string $option_verouillage): self
    {
        $this->option_verouillage = $option_verouillage;

        return $this;
    }

    public function getPossibilite(): ?string
    {
        return $this->possibilite;
    }

    public function setPossibilite(?string $possibilite): self
    {
        $this->possibilite = $possibilite;

        return $this;
    }

    public function getCir(): ?string
    {
        return $this->cir;
    }

    public function setCir(?string $cir): self
    {
        $this->cir = $cir;

        return $this;
    }

    public function getMission(): ?string
    {
        return $this->mission;
    }

    public function setMission(?string $mission): self
    {
        $this->mission = $mission;

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

    public function getRoles(): ?array
    {
        return $this->roles;
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    public function getChef(): ?self
    {
        return $this->chef;
    }

    public function setChef(?self $chef): self
    {
        $this->chef = $chef;

        return $this;
    }

    /**
     * @return Collection<int, self>
     */
    public function getSalaries(): Collection
    {
        return $this->salaries;
    }

    public function addSalary(self $salary): self
    {
        if (!$this->salaries->contains($salary)) {
            $this->salaries[] = $salary;
            $salary->setChef($this);
        }

        return $this;
    }

    public function removeSalary(self $salary): self
    {
        if ($this->salaries->removeElement($salary)) {
            // set the owning side to null (unless already changed)
            if ($salary->getChef() === $this) {
                $salary->setChef(null);
            }
        }

        return $this;
    }

    public function getDrd1(): ?self
    {
        return $this->drd1;
    }

    public function setDrd1(?self $drd1): self
    {
        $this->drd1 = $drd1;

        return $this;
    }

    public function getDrd2(): ?self
    {
        return $this->drd2;
    }

    public function setDrd2(?self $drd2): self
    {
        $this->drd2 = $drd2;

        return $this;
    }

    /**
     * @return Collection<int, Equipe>
     */
    public function getEquipe(): Collection
    {
        return $this->equipe;
    }

    public function addEquipe(Equipe $equipe): self
    {
        if (!$this->equipe->contains($equipe)) {
            $this->equipe[] = $equipe;
        }

        return $this;
    }

    public function removeEquipe(Equipe $equipe): self
    {
        $this->equipe->removeElement($equipe);

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
            $declaration->setUser($this);
        }

        return $this;
    }

    public function removeDeclaration(declaration $declaration): self
    {
        if ($this->declaration->removeElement($declaration)) {
            // set the owning side to null (unless already changed)
            if ($declaration->getUser() === $this) {
                $declaration->setUser(null);
            }
        }

        return $this;
    }
}
