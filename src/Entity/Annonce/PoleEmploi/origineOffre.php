<?php

namespace App\Entity\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi;
use App\Repository\Annonce\PoleEmploi\origineOffreRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi_origine_offre")
 * @ORM\Entity(repositoryClass=origineOffreRepository::class)
 */
class origineOffre
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $origine;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlOrigine;

    /**
     * @ORM\OneToMany(targetEntity=partenaires::class, mappedBy="origineOffre")
     */
    private $partenaires;

    /**
     * @ORM\OneToMany(targetEntity=PoleEmploi::class, mappedBy="origineOffre")
     */
    private $Annonces;

    public function __construct()
    {
        $this->partenaires = new ArrayCollection();
        $this->Annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getOrigine(): ?int
    {
        return $this->origine;
    }

    public function setOrigine(?int $origine): self
    {
        $this->origine = $origine;

        return $this;
    }

    public function getUrlOrigine(): ?string
    {
        return $this->urlOrigine;
    }

    public function setUrlOrigine(?string $urlOrigine): self
    {
        $this->urlOrigine = $urlOrigine;

        return $this;
    }

    /**
     * @return Collection|partenaires[]
     */
    public function getPartenaires(): Collection
    {
        return $this->partenaires;
    }

    public function addPartenaire(partenaires $partenaire): self
    {
        if (!$this->partenaires->contains($partenaire)) {
            $this->partenaires[] = $partenaire;
            $partenaire->setOrigineOffre($this);
        }

        return $this;
    }

    public function removePartenaire(partenaires $partenaire): self
    {
        if ($this->partenaires->removeElement($partenaire)) {
            // set the owning side to null (unless already changed)
            if ($partenaire->getOrigineOffre() === $this) {
                $partenaire->setOrigineOffre(null);
            }
        }

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
            $annonce->setOrigineOffre($this);
        }

        return $this;
    }

    public function removeAnnonce(PoleEmploi $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getOrigineOffre() === $this) {
                $annonce->setOrigineOffre(null);
            }
        }

        return $this;
    }
}
