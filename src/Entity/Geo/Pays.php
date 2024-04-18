<?php

namespace App\Entity\Geo;

use App\Repository\Geo\PaysRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="geography_pays")
 * @ORM\Entity(repositoryClass=PaysRepository::class)
 */
class Pays
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="smallint", length=3)
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=2)
     */
    private $alpha2;

    /**
     * @ORM\Column(type="string", length=3)
     */
    private $alpha3;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom_en_gb;

    /**
     * @ORM\Column(type="string", length=45)
     */
    private $nom_fr_fr;

    /**
     * @ORM\OneToMany(targetEntity=Regions::class, mappedBy="pays")
     */
    private $regions;

    public function __construct()
    {
        $this->regions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCode(): ?int
    {
        return $this->code;
    }

    public function setCode(int $code): self
    {
        $this->code = $code;

        return $this;
    }

    public function getAlpha2(): ?string
    {
        return $this->alpha2;
    }

    public function setAlpha2(string $alpha2): self
    {
        $this->alpha2 = $alpha2;

        return $this;
    }

    public function getAlpha3(): ?string
    {
        return $this->alpha3;
    }

    public function setAlpha3(string $alpha3): self
    {
        $this->alpha3 = $alpha3;

        return $this;
    }

    public function getNomEnGb(): ?string
    {
        return $this->nom_en_gb;
    }

    public function setNomEnGb(string $nom_en_gb): self
    {
        $this->nom_en_gb = $nom_en_gb;

        return $this;
    }

    public function getNomFrFr(): ?string
    {
        return $this->nom_fr_fr;
    }

    public function setNomFrFr(string $nom_fr_fr): self
    {
        $this->nom_fr_fr = $nom_fr_fr;

        return $this;
    }

    /**
     * @return Collection|Regions[]
     */
    public function getRegions(): Collection
    {
        return $this->regions;
    }

    public function addRegion(Regions $region): self
    {
        if (!$this->regions->contains($region)) {
            $this->regions[] = $region;
            $region->setPays($this);
        }

        return $this;
    }

    public function removeRegion(Regions $region): self
    {
        if ($this->regions->removeElement($region)) {
            // set the owning side to null (unless already changed)
            if ($region->getPays() === $this) {
                $region->setPays(null);
            }
        }

        return $this;
    }
}
