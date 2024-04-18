<?php

namespace App\Entity\Annonce\Indeed;

use App\Entity\Annonce\Indeed;
use App\Repository\Annonce\Indeed\LocalityRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_indeed_locality")
 * @ORM\Entity(repositoryClass=LocalityRepository::class)
 */
class Locality
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
    private $city;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $country;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $state;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $postalCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $streetAdress;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $remotetype;

    /**
     * @ORM\OneToMany(targetEntity=Indeed::class, mappedBy="locality")
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

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function setCity(string $city): self
    {
        $this->city = $city;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): self
    {
        $this->country = $country;

        return $this;
    }

    public function getState(): ?string
    {
        return $this->state;
    }

    public function setState(string $state): self
    {
        $this->state = $state;

        return $this;
    }

    public function getPostalCode(): ?string
    {
        return $this->postalCode;
    }

    public function setPostalCode(?string $postalCode): self
    {
        $this->postalCode = $postalCode;

        return $this;
    }

    public function getStreetAdress(): ?string
    {
        return $this->streetAdress;
    }

    public function setStreetAdress(?string $streetAdress): self
    {
        $this->streetAdress = $streetAdress;

        return $this;
    }

    public function getRemotetype(): ?string
    {
        return $this->remotetype;
    }

    public function setRemotetype(?string $remotetype): self
    {
        $this->remotetype = $remotetype;

        return $this;
    }

    /**
     * @return Collection|Indeed[]
     */
    public function getAnnonces(): Collection
    {
        return $this->Annonces;
    }

    public function addAnnonce(Indeed $annonce): self
    {
        if (!$this->Annonces->contains($annonce)) {
            $this->Annonces[] = $annonce;
            $annonce->setLocality($this);
        }

        return $this;
    }

    public function removeAnnonce(Indeed $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getLocality() === $this) {
                $annonce->setLocality(null);
            }
        }

        return $this;
    }
}
