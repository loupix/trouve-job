<?php

namespace App\Entity\Geo;

use App\Entity\Annonce;
use App\Entity\Entreprise;
use App\Repository\Geo\VillesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

/**
 * @ORM\Table(name="geography_villes")
 * @ORM\Entity(repositoryClass=VillesRepository::class)
 */
class Villes
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
    private $slug;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $nom_simple;

    /**
     * @ORM\Column(type="string", length=45, nullable=true)
     */
    private $nom_reel;

    /**
     * @ORM\Column(type="string", length=20, nullable=true)
     */
    private $nom_soundex;

    /**
     * @ORM\Column(type="string", length=22, nullable=true)
     */
    private $nom_metaphone;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $code_postal;

    /**
     * @ORM\Column(type="string", length=3, nullable=true)
     */
    private $commune;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $code_commune;

    /**
     * @ORM\Column(type="smallint", nullable=true)
     */
    private $arrondissement;

    /**
     * @ORM\Column(type="smallint", length=5, nullable=true)
     */
    private $amdi;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $population_2010;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $population_1999;

    /**
     * @ORM\Column(type="integer", length=10, nullable=true)
     */
    private $population_2012;

    /**
     * @ORM\Column(type="integer", length=11, nullable=true)
     */
    private $densite_2010;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $surface;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $longitude_deg;

    /**
     * @ORM\Column(type="float", nullable=true)
     */
    private $latitude_deg;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $longitude_grd;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $latitude_grd;

    /**
     * @ORM\Column(type="string", length=9, nullable=true)
     */
    private $longitude_dms;

    /**
     * @ORM\Column(type="string", length=8, nullable=true)
     */
    private $latitude_dms;

    /**
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $zmin;

    /**
     * @ORM\Column(type="integer", length=4, nullable=true)
     */
    private $zmax;

    /**
     * @ORM\ManyToOne(targetEntity=Cantons::class, inversedBy="villes", cascade={"persist"})
     */
    private $canton;

    /**
     * @ORM\ManyToOne(targetEntity=Departements::class, inversedBy="villes", cascade={"persist"})
     */
    private $departement;

    /**
     * @ORM\ManyToOne(targetEntity=Regions::class, inversedBy="villes", cascade={"persist"})
     */
    private $region;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="Ville")
     */
    private $annonces;

    /**
     * @ORM\ManyToMany(targetEntity=Entreprise::class, mappedBy="villes")
     * @ORM\JoinTable(name="entreprises_geography_villes")
     */
    private $entreprises;

    public function __construct()
    {
        $this->annonces = new ArrayCollection();
        $this->entreprises = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getSlug(): ?string
    {
        return $this->slug;
    }

    public function setSlug(?string $slug): self
    {
        $this->slug = $slug;

        return $this;
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

    public function getNomSimple(): ?string
    {
        return $this->nom_simple;
    }

    public function setNomSimple(?string $nom_simple): self
    {
        $this->nom_simple = $nom_simple;

        return $this;
    }

    public function getNomReel(): ?string
    {
        return $this->nom_reel;
    }

    public function setNomReel(?string $nom_reel): self
    {
        $this->nom_reel = $nom_reel;

        return $this;
    }

    public function getNomSoundex(): ?string
    {
        return $this->nom_soundex;
    }

    public function setNomSoundex(?string $nom_soundex): self
    {
        $this->nom_soundex = $nom_soundex;

        return $this;
    }

    public function getNomMetaphone(): ?string
    {
        return $this->nom_metaphone;
    }

    public function setNomMetaphone(?string $nom_metaphone): self
    {
        $this->nom_metaphone = $nom_metaphone;

        return $this;
    }

    public function getCodePostal(): ?string
    {
        return $this->code_postal;
    }

    public function setCodePostal(?string $code_postal): self
    {
        $this->code_postal = $code_postal;

        return $this;
    }

    public function getCommune(): ?string
    {
        return $this->commune;
    }

    public function setCommune(?string $commune): self
    {
        $this->commune = $commune;

        return $this;
    }

    public function getCodeCommune(): ?string
    {
        return $this->code_commune;
    }

    public function setCodeCommune(?string $code_commune): self
    {
        $this->code_commune = $code_commune;

        return $this;
    }

    public function getArrondissement(): ?int
    {
        return $this->arrondissement;
    }

    public function setArrondissement(?int $arrondissement): self
    {
        $this->arrondissement = $arrondissement;

        return $this;
    }

    public function getAmdi(): ?int
    {
        return $this->amdi;
    }

    public function setAmdi(?int $amdi): self
    {
        $this->amdi = $amdi;

        return $this;
    }

    public function getPopulation2010(): ?int
    {
        return $this->population_2010;
    }

    public function setPopulation2010(?int $population_2010): self
    {
        $this->population_2010 = $population_2010;

        return $this;
    }

    public function getPopulation1999(): ?int
    {
        return $this->population_1999;
    }

    public function setPopulation1999(?int $population_1999): self
    {
        $this->population_1999 = $population_1999;

        return $this;
    }

    public function getPopulation2012(): ?int
    {
        return $this->population_2012;
    }

    public function setPopulation2012(?int $population_2012): self
    {
        $this->population_2012 = $population_2012;

        return $this;
    }

    public function getDensite2010(): ?int
    {
        return $this->densite_2010;
    }

    public function setDensite2010(?int $densite_2010): self
    {
        $this->densite_2010 = $densite_2010;

        return $this;
    }

    public function getSurface(): ?float
    {
        return $this->surface;
    }

    public function setSurface(?float $surface): self
    {
        $this->surface = $surface;

        return $this;
    }

    public function getLongitudeDeg(): ?float
    {
        return $this->longitude_deg;
    }

    public function setLongitudeDeg(?float $longitude_deg): self
    {
        $this->longitude_deg = $longitude_deg;

        return $this;
    }

    public function getLatitudeDeg(): ?float
    {
        return $this->latitude_deg;
    }

    public function setLatitudeDeg(?float $latitude_deg): self
    {
        $this->latitude_deg = $latitude_deg;

        return $this;
    }

    public function getLongitudeGrd(): ?string
    {
        return $this->longitude_grd;
    }

    public function setLongitudeGrd(?string $longitude_grd): self
    {
        $this->longitude_grd = $longitude_grd;

        return $this;
    }

    public function getLatitudeGrd(): ?string
    {
        return $this->latitude_grd;
    }

    public function setLatitudeGrd(string $latitude_grd): self
    {
        $this->latitude_grd = $latitude_grd;

        return $this;
    }

    public function getLongitudeDms(): ?string
    {
        return $this->longitude_dms;
    }

    public function setLongitudeDms(?string $longitude_dms): self
    {
        $this->longitude_dms = $longitude_dms;

        return $this;
    }

    public function getLatitudeDms(): ?string
    {
        return $this->latitude_dms;
    }

    public function setLatitudeDms(?string $latitude_dms): self
    {
        $this->latitude_dms = $latitude_dms;

        return $this;
    }

    public function getZmin(): ?int
    {
        return $this->zmin;
    }

    public function setZmin(?int $zmin): self
    {
        $this->zmin = $zmin;

        return $this;
    }

    public function getZmax(): ?int
    {
        return $this->zmax;
    }

    public function setZmax(?int $zmax): self
    {
        $this->zmax = $zmax;

        return $this;
    }

    public function getCanton(): ?Cantons
    {
        return $this->canton;
    }

    public function setCanton(?Cantons $canton): self
    {
        $this->canton = $canton;

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
     * @return Collection|Annonce[]
     */
    public function getAnnonces(): Collection
    {
        return $this->annonces;
    }

    public function addAnnonce(Annonce $annonce): self
    {
        if (!$this->annonces->contains($annonce)) {
            $this->annonces[] = $annonce;
            $annonce->setVille($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getVille() === $this) {
                $annonce->setVille(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Entreprise[]
     */
    public function getEntreprises(): Collection
    {
        return $this->entreprises;
    }

    public function addEntreprise(Entreprise $entreprise): self
    {
        if (!$this->entreprises->contains($entreprise)) {
            $this->entreprises[] = $entreprise;
            $entreprise->addVille($this);
        }

        return $this;
    }

    public function removeEntreprise(Entreprise $entreprise): self
    {
        if ($this->entreprises->removeElement($entreprise)) {
            $entreprise->removeVille($this);
        }

        return $this;
    }
}
