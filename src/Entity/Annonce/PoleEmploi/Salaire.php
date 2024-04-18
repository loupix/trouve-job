<?php

namespace App\Entity\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi;
use App\Repository\Annonce\PoleEmploi\SalaireRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi_salaire")
 * @ORM\Entity(repositoryClass=SalaireRepository::class)
 */
class Salaire
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $libelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complement1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complement2;

    /**
     * @ORM\OneToMany(targetEntity=PoleEmploi::class, mappedBy="salaire")
     */
    private $Annonces;

    public function __construct()
    {
        $this->Annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getLibelle(): ?string
    {
        return $this->libelle;
    }

    public function setLibelle(?string $libelle): self
    {
        $this->libelle = $libelle;

        return $this;
    }

    public function getCommentaire(): ?string
    {
        return $this->commentaire;
    }

    public function setCommentaire(?string $commentaire): self
    {
        $this->commentaire = $commentaire;

        return $this;
    }

    public function getComplement1(): ?string
    {
        return $this->complement1;
    }

    public function setComplement1(?string $complement1): self
    {
        $this->complement1 = $complement1;

        return $this;
    }

    public function getComplement2(): ?string
    {
        return $this->complement2;
    }

    public function setComplement2(?string $complement2): self
    {
        $this->complement2 = $complement2;

        return $this;
    }

    /**
     * @return Collection|PoleEmploi[]
     */
    public function getAnnonces(): Collection
    {
        return $this->Annonces;
    }

    public function addAnnonce(PoleEmploi $annonce): self
    {
        if (!$this->Annonces->contains($annonce)) {
            $this->Annonces[] = $annonce;
            $annonce->setSalaire($this);
        }

        return $this;
    }

    public function removeAnnonce(PoleEmploi $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getSalaire() === $this) {
                $annonce->setSalaire(null);
            }
        }

        return $this;
    }
}
