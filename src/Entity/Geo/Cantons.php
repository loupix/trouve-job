<?php

namespace App\Entity\Geo;

use App\Repository\Geo\CantonsRepository;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;
use Doctrine\Common\Collections\ArrayCollection;

/**
 * @ORM\Table(name="geography_cantons")
 * @ORM\Entity(repositoryClass=CantonsRepository::class)
 */
class Cantons
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $nom;

    /**
     * @ORM\OneToOne(targetEntity=Villes::class, cascade={"persist", "remove"})
     */
    private $chefLieu;

    /**
     * @ORM\ManyToOne(targetEntity=Departements::class, inversedBy="cantons")
     */
    private $departement;

    /**
     * @ORM\OneToMany(targetEntity=Villes::class, mappedBy="canton")
     */
    private $villes;

    public function __construct()
    {
        $this->villes = new ArrayCollection();
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

    public function getChefLieu(): ?Villes
    {
        return $this->chefLieu;
    }

    public function setChefLieu(?Villes $chefLieu): self
    {
        $this->chefLieu = $chefLieu;

        return $this;
    }

    public function getDepartement(): ?Departements
    {
        return $this->departement;
    }

    public function setDepartement(?Departements $departement): self
    {
        $this->departement = $departement;

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
            $ville->setCanton($this);
        }

        return $this;
    }

    public function removeVille(Villes $ville): self
    {
        if ($this->villes->removeElement($ville)) {
            // set the owning side to null (unless already changed)
            if ($ville->getCanton() === $this) {
                $ville->setCanton(null);
            }
        }

        return $this;
    }
}
