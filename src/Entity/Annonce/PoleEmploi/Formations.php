<?php

namespace App\Entity\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi;
use App\Repository\Annonce\PoleEmploi\FormationsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi_formations")
 * @ORM\Entity(repositoryClass=FormationsRepository::class)
 */
class Formations
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
    private $domaineLibelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $niveauLibelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $exigence;

    /**
     * @ORM\OneToMany(targetEntity=PoleEmploi::class, mappedBy="formations")
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

    public function getDomaineLibelle(): ?string
    {
        return $this->domaineLibelle;
    }

    public function setDomaineLibelle(?string $domaineLibelle): self
    {
        $this->domaineLibelle = $domaineLibelle;

        return $this;
    }

    public function getNiveauLibelle(): ?string
    {
        return $this->niveauLibelle;
    }

    public function setNiveauLibelle(?string $niveauLibelle): self
    {
        $this->niveauLibelle = $niveauLibelle;

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

    public function getExigence(): ?string
    {
        return $this->exigence;
    }

    public function setExigence(?string $exigence): self
    {
        $this->exigence = $exigence;

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
            $annonce->setFormations($this);
        }

        return $this;
    }

    public function removeAnnonce(PoleEmploi $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getFormations() === $this) {
                $annonce->setFormations(null);
            }
        }

        return $this;
    }
}
