<?php

namespace App\Entity\User;

use App\Entity\Jobs\Etudes;
use App\Entity\Jobs\Metiers;
use App\Entity\Jobs\Secteurs;
use App\Entity\Jobs\Technologies;
use App\Repository\User\RegisteredRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;

/**
 * @ORM\Table(name="user_registered")
 * @ORM\Entity(repositoryClass=RegisteredRepository::class)
 * @UniqueEntity(fields={"Email"}, message="There is already an account with this Email")
 */
class Registered extends User
{
    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Nom;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $Prenom;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $Email;

    /**
     * @ORM\Column(type="boolean")
     */
    private $isVerified = false;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $Bitrhday;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $picture;

    /**
     * @ORM\ManyToMany(targetEntity=Metiers::class)
     * @ORM\JoinTable(name="user_registered_jobs_metiers")
     */
    private $Metiers;

    /**
     * @ORM\ManyToMany(targetEntity=Secteurs::class)
     * @ORM\JoinTable(name="user_registered_jobs_secteurs")
     */
    private $Secteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Etudes::class)
     * @ORM\JoinTable(name="user_registered_jobs_etudes")
     */
    private $Etudes;

    /**
     * @ORM\ManyToMany(targetEntity=Technologies::class)
     * @ORM\JoinTable(name="user_registered_jobs_technologies")
     */
    private $Technologies;

    public function __construct()
    {
        parent::__construct();
        $this->setRoles(Array("ROLE_USER", "ROLE_REGISTER"));
        $this->Metiers = new ArrayCollection();
        $this->Secteurs = new ArrayCollection();
        $this->Etudes = new ArrayCollection();
        $this->Technologies = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Email;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->Email;
    }

    public function getNom(): ?string
    {
        return $this->Nom;
    }

    public function setNom(string $Nom): self
    {
        $this->Nom = $Nom;

        return $this;
    }

    public function getPrenom(): ?string
    {
        return $this->Prenom;
    }

    public function setPrenom(string $Prenom): self
    {
        $this->Prenom = $Prenom;

        return $this;
    }

    public function getEmail(): ?string
    {
        return $this->Email;
    }

    public function setEmail(string $Email): self
    {
        $this->Email = $Email;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setIsVerified(bool $isVerified): self
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    public function getBitrhday(): ?\DateTimeInterface
    {
        return $this->Bitrhday;
    }

    public function setBitrhday(?\DateTimeInterface $Bitrhday): self
    {
        $this->Bitrhday = $Bitrhday;

        return $this;
    }

    public function getPicture()
    {
        return $this->picture;
    }

    public function setPicture($picture): self
    {
        $this->picture = $picture;

        return $this;
    }

    /**
     * @return Collection|Metiers[]
     */
    public function getMetiers(): Collection
    {
        return $this->Metiers;
    }

    public function addMetier(Metiers $metier): self
    {
        if (!$this->Metiers->contains($metier)) {
            $this->Metiers[] = $metier;
        }

        return $this;
    }

    public function removeMetier(Metiers $metier): self
    {
        $this->Metiers->removeElement($metier);

        return $this;
    }

    /**
     * @return Collection|Secteurs[]
     */
    public function getSecteurs(): Collection
    {
        return $this->Secteurs;
    }

    public function addSecteur(Secteurs $secteur): self
    {
        if (!$this->Secteurs->contains($secteur)) {
            $this->Secteurs[] = $secteur;
        }

        return $this;
    }

    public function removeSecteur(Secteurs $secteur): self
    {
        $this->Secteurs->removeElement($secteur);

        return $this;
    }

    /**
     * @return Collection|Etudes[]
     */
    public function getEtudes(): Collection
    {
        return $this->Etudes;
    }

    public function addEtude(Etudes $etude): self
    {
        if (!$this->Etudes->contains($etude)) {
            $this->Etudes[] = $etude;
        }

        return $this;
    }

    public function removeEtude(Etudes $etude): self
    {
        $this->Etudes->removeElement($etude);

        return $this;
    }

    /**
     * @return Collection|Technologies[]
     */
    public function getTechnologies(): Collection
    {
        return $this->Technologies;
    }

    public function addTechnology(Technologies $technology): self
    {
        if (!$this->Technologies->contains($technology)) {
            $this->Technologies[] = $technology;
        }

        return $this;
    }

    public function removeTechnology(Technologies $technology): self
    {
        $this->Technologies->removeElement($technology);

        return $this;
    }
}
