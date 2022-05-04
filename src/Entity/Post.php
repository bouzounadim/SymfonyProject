<?php

namespace App\Entity;

use App\Repository\PostRepository;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Serializer\Annotation\Groups;
use Symfony\Component\Validator\Constraints as Assert;
/**
 * @ORM\Entity(repositoryClass=PostRepository::class)
 */
class Post
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     * @Groups("post")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post")
     * @Assert\NotBlank
     */
    private $Titre;

    /**
     * @ORM\Column(type="string", length=255)
     * @Groups("post")
     * @Assert\NotBlank
     */
    private $imageurl;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTitre(): ?string
    {
        return $this->Titre;
    }

    public function setTitre(string $Titre): self
    {
        $this->Titre = $Titre;

        return $this;
    }

    public function getImageurl(): ?string
    {
        return $this->imageurl;
    }

    public function setImageurl(string $imageurl): self
    {
        $this->imageurl = $imageurl;

        return $this;
    }

    public function asArray(): array
    {
        return [
            'id' => $this->id,
            'Titre' => $this->Titre,
            'imageurl' => $this->imageurl
        ];
    }
}
