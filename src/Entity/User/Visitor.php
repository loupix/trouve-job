<?php

namespace App\Entity\User;

use App\Entity\Jobs\Metiers;
use App\Entity\Jobs\Secteurs;
use App\Repository\User\VisitorRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="user_visitor")
 * @ORM\Entity(repositoryClass=VisitorRepository::class)
 */
class Visitor extends User
{

    /**
     * @ORM\Column(type="string", length=16, unique=true)
     */
    private $Name;

    /**
     * @ORM\Column(type="string", length=255, unique=true)
     */
    private $session_id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $password_clear;

    /**
     * @ORM\ManyToMany(targetEntity=Metiers::class)
     * @ORM\JoinTable(name="user_visitor_jobs_metiers")
     */
    private $Metiers;

    /**
     * @ORM\ManyToMany(targetEntity=Secteurs::class)
     * @ORM\JoinTable(name="user_visitor_jobs_secteurs")
     */
    private $Secteurs;

    public function __construct()
    {
        parent::__construct();
        $this->setName(substr(uniqid("Visitor_"), 0, 16));
        $this->setPasswordClear(uniqid());
        $this->setRoles(Array("ROLE_USER", "ROLE_VISITOR"));
        $this->Metiers = new ArrayCollection();
        $this->Secteurs = new ArrayCollection();
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->Name;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->Name;
    }

    public function getName(): ?string
    {
        return $this->Name;
    }

    public function setName(string $Name): self
    {
        $this->Name = $Name;

        return $this;
    }

    public function getSessionId(): ?string
    {
        return $this->session_id;
    }

    public function setSessionId(string $session_id): self
    {
        $this->session_id = $session_id;

        return $this;
    }

    public function getPasswordClear(): ?string
    {
        return $this->password_clear;
    }

    public function setPasswordClear(string $password_clear): self
    {
        $this->password_clear = $password_clear;

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
}
