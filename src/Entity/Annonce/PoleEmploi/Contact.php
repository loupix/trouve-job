<?php

namespace App\Entity\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi;
use App\Repository\Annonce\PoleEmploi\ContactRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi_contact")
 * @ORM\Entity(repositoryClass=ContactRepository::class)
 */
class Contact
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordonnees1;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordonnees2;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $coordonnees3;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $telephone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $courriel;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $commentaire;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlRecruteur;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $urlPostulation;

    /**
     * @ORM\OneToMany(targetEntity=PoleEmploi::class, mappedBy="contact")
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

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(?string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getCoordonnees1(): ?string
    {
        return $this->coordonnees1;
    }

    public function setCoordonnees1(?string $coordonnees1): self
    {
        $this->coordonnees1 = $coordonnees1;

        return $this;
    }

    public function getCoordonnees2(): ?string
    {
        return $this->coordonnees2;
    }

    public function setCoordonnees2(?string $coordonnees2): self
    {
        $this->coordonnees2 = $coordonnees2;

        return $this;
    }

    public function getCoordonnees3(): ?string
    {
        return $this->coordonnees3;
    }

    public function setCoordonnees3(?string $coordonnees3): self
    {
        $this->coordonnees3 = $coordonnees3;

        return $this;
    }

    public function getTelephone(): ?string
    {
        return $this->telephone;
    }

    public function setTelephone(?string $telephone): self
    {
        $this->telephone = $telephone;

        return $this;
    }

    public function getCourriel(): ?string
    {
        return $this->courriel;
    }

    public function setCourriel(?string $courriel): self
    {
        $this->courriel = $courriel;

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

    public function getUrlRecruteur(): ?string
    {
        return $this->urlRecruteur;
    }

    public function setUrlRecruteur(?string $urlRecruteur): self
    {
        $this->urlRecruteur = $urlRecruteur;

        return $this;
    }

    public function getUrlPostulation(): ?string
    {
        return $this->urlPostulation;
    }

    public function setUrlPostulation(?string $urlPostulation): self
    {
        $this->urlPostulation = $urlPostulation;

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
            $annonce->setContact($this);
        }

        return $this;
    }

    public function removeAnnonce(PoleEmploi $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getContact() === $this) {
                $annonce->setContact(null);
            }
        }

        return $this;
    }
}
