<?php

namespace App\Entity\Geo;

use App\Repository\Geo\DepartementsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="geography_departements")
 * @ORM\Entity(repositoryClass=DepartementsRepository::class)
 */
class Departements
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Villes::class, cascade={"persist", "remove"})
     */
    private $prefecture;

    /**
     * @ORM\ManyToOne(targetEntity=Regions::class, inversedBy="departements")
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Cantons::class, mappedBy="departement")
     */
    private $cantons;

    /**
     * @ORM\OneToMany(targetEntity=Villes::class, mappedBy="departement")
     */
    private $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
        $this->cantons = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?string
    {
        return $this->code;
    }

    public function setCode(?string $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): self
    {
        $this->nom = $nom;

        return $this;
    }

    public function getPrefecture(): ?Villes
    {
        return $this->prefecture;
    }

    public function setPrefecture(?Villes $prefecture): self
    {
        $this->prefecture = $prefecture;

        return $this;
    }

    public function getRegion(): ?Regions
    {
        return $this->region;
    }

    public function setRegion(?Regions $region): self
    {
        $this->region = $region;

        return $this;
    }

    /**
     * @return Collection|Cantons[]
     */
    public function getCantons(): Collection
    {
        return $this->cantons;
    }

    public function addCanton(Cantons $canton): self
    {
        if (!$this->cantons->contains($canton)) {
            $this->cantons[] = $canton;
            $canton->setDepartement($this);
        }

        return $this;
    }

    public function removeCanton(Cantons $canton): self
    {
        if ($this->cantons->removeElement($canton)) {
            // set the owning side to null (unless already changed)
            if ($canton->getDepartement() === $this) {
                $canton->setDepartement(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Villes[]
     */
    public function getVilles(): Collection
    {
        return $this->villes;
    }

    public function addVille(Villes $ville): self
    {
        if (!$this->villes->contains($ville)) {
            $this->villes[] = $ville;
            $ville->setDepartement($this);
        }

        return $this;
    }

    public function removeVille(Villes $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getDepartement() === $this) {
                $ville->setDepartement(null);
            }
        }

        return $this;
    }
}
