<?php

namespace App\Entity;

use App\Repository\InteretRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=InteretRepository::class)
 */
class Interet
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $sport;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $ville;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $matiere;

    /**
     * @ORM\Column(type="string", length=255 , nullable=true)
     */
    private $hobbie;

    /**
     * @ORM\ManyToMany(targetEntity=User::class, inversedBy="interets")
     */
    private $relation;

    public function __construct()
    {
        $this->relation = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSport(): ?string
    {
        return $this->sport;
    }

    public function setSport(string $sport): self
    {
        $this->sport = $sport;

        return $this;
    }

    public function getVille(): ?string
    {
        return $this->ville;
    }

    public function setVille(string $ville): self
    {
        $this->ville = $ville;

        return $this;
    }

    public function getMatiere(): ?string
    {
        return $this->matiere;
    }

    public function setMatiere(string $matiere): self
    {
        $this->matiere = $matiere;

        return $this;
    }

    public function getHobbie(): ?string
    {
        return $this->hobbie;
    }

    public function setHobbie(string $hobbie): self
    {
        $this->hobbie = $hobbie;

        return $this;
    }

    /**
     * @return Collection|User[]
     */
    public function getRelation(): Collection
    {
        return $this->relation;
    }

    public function addRelation(User $relation): self
    {
        if (!$this->relation->contains($relation)) {
            $this->relation[] = $relation;
        }

        return $this;
    }

    public function removeRelation(User $relation): self
    {
        $this->relation->removeElement($relation);

        return $this;
    }
}
