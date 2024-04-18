<?php

namespace App\Entity;

use App\Entity\Geo\Villes;
use App\Entity\Jobs\Contrats;
use App\Entity\Jobs\Etudes;
use App\Entity\Jobs\Metiers;
use App\Entity\Jobs\Secteurs;
use App\Entity\Jobs\Technologies;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

use App\Entity\Annonce\Indeed;
use App\Entity\Annonce\LinkedIn;
use App\Entity\Annonce\PoleEmploi;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces")
 * @ORM\Entity(repositoryClass=AnnonceRepository::class)
 */
class Annonce
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string")
     */
    private $type;

    /**
     * @ORM\OneToOne(targetEntity=PoleEmploi::class, cascade={"persist", "remove"})
     */
    private $poleEmploi;

    /**
     * @ORM\OneToOne(targetEntity=Indeed::class, cascade={"persist", "remove"})
     */
    private $indeed;

    /**
     * @ORM\OneToOne(targetEntity=LinkedIn::class, cascade={"persist", "remove"})
     */
    private $linkedIn;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="Annonces")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=Contrats::class, inversedBy="annonces")
     * @ORM\JoinTable(name="annonces_jobs_contrats")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Contrat;

    /**
     * @ORM\ManyToMany(targetEntity=Etudes::class, inversedBy="annonces")
     * @ORM\JoinTable(name="annonces_jobs_etudes")
     */
    private $Etudes;

    /**
     * @ORM\ManyToMany(targetEntity=Secteurs::class, inversedBy="annonces")
     * @ORM\JoinTable(name="annonces_jobs_secteurs")
     */
    private $Secteurs;

    /**
     * @ORM\ManyToMany(targetEntity=Technologies::class, inversedBy="annonces")
     * @ORM\JoinTable(name="annonces_jobs_technologies")
     */
    private $Technologies;

    /**
     * @ORM\ManyToOne(targetEntity=Metiers::class, inversedBy="annonces")
     */
    private $Metier;

    /**
     * @ORM\ManyToOne(targetEntity=Villes::class, inversedBy="annonces")
     * @ORM\JoinColumn(nullable=false)
     */
    private $Ville;

    protected $titre;
    protected $description;

    public function __construct()
    {
        $this->Etudes = new ArrayCollection();
        $this->Secteurs = new ArrayCollection();
        $this->Technologies = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getType(): ?string
    {
        return $this->type;
    }

    public function setType(string $type): self
    {
        $this->type = $type;

        return $this;
    }

    public function getPoleEmploi(): ?PoleEmploi
    {
        return $this->poleEmploi;
    }

    public function setPoleEmploi(?PoleEmploi $poleEmploi): self
    {
        $this->poleEmploi = $poleEmploi;

        return $this;
    }

    public function getIndeed(): ?Indeed
    {
        return $this->indeed;
    }

    public function setIndeed(?Indeed $indeed): self
    {
        $this->indeed = $indeed;

        return $this;
    }

    public function getLinkedIn(): ?LinkedIn
    {
        return $this->linkedIn;
    }

    public function setLinkedIn(?LinkedIn $linkedIn): self
    {
        $this->linkedIn = $linkedIn;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

        return $this;
    }

    public function getContrat(): ?Contrats
    {
        return $this->Contrat;
    }

    public function setContrat(?Contrats $Contrat): self
    {
        $this->Contrat = $Contrat;

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

    public function getMetier(): ?Metiers
    {
        return $this->Metier;
    }

    public function setMetier(?Metiers $Metier): self
    {
        $this->Metier = $Metier;

        return $this;
    }

    public function getVille(): ?Villes
    {
        return $this->Ville;
    }

    public function setVille(?Villes $Ville): self
    {
        $this->Ville = $Ville;

        return $this;
    }

    public function getTitre(): ?string
    {
        return $this->titre;
    }

    public function setTitre(string $titre): self
    {
        $this->titre = $titre;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(string $description): self
    {
        $this->description = $description;

        return $this;
    }
}
