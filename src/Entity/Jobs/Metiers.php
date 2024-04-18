<?php

namespace App\Entity\Jobs;

use App\Entity\Annonce;
use App\Entity\User\Registered;
use App\Repository\Jobs\MetiersRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jobs_metiers")
 * @ORM\Entity(repositoryClass=MetiersRepository::class)
 */
class Metiers
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $code_rome;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $summary;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Secteurs::class, inversedBy="metiers")
     */
    private $secteur;

    /**
     * @ORM\ManyToOne(targetEntity=Metiers::class, inversedBy="synonymes")
     */
    private $parentSynonyme;

    /**
     * @ORM\OneToMany(targetEntity=Metiers::class, mappedBy="parentSynonyme")
     */
    private $synonymes;

    /**
     * @ORM\ManyToMany(targetEntity=Interets::class, mappedBy="Metiers")
     * @ORM\JoinTable(name="jobs_interets_metiers")
     */
    private $interets;

    /**
     * @ORM\ManyToMany(targetEntity=Metiers::class, inversedBy="same_as")
     * @ORM\JoinTable(name="jobs_metiers_same")
     */
    private $same_as;

    /**
     * @ORM\OneToMany(targetEntity=Annonce::class, mappedBy="Metier")
     */
    private $annonces;

    public function __construct()
    {
        $this->synonymes = new ArrayCollection();
        $this->interets = new ArrayCollection();
        $this->same_as = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCodeRome(): ?string
    {
        return $this->code_rome;
    }

    public function setCodeRome(?string $code_rome): self
    {
        $this->code_rome = $code_rome;

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

    public function getSummary(): ?string
    {
        return $this->summary;
    }

    public function setSummary(?string $summary): self
    {
        $this->summary = $summary;

        return $this;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getSecteur(): ?Secteurs
    {
        return $this->secteur;
    }

    public function setSecteur(?Secteurs $secteur): self
    {
        $this->secteur = $secteur;

        return $this;
    }

    public function getParentSynonyme(): ?self
    {
        return $this->parentSynonyme;
    }

    public function setParentSynonyme(?self $parentSynonyme): self
    {
        $this->parentSynonyme = $parentSynonyme;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSynonymes(): Collection
    {
        return $this->synonymes;
    }

    public function addSynonyme(self $synonyme): self
    {
        if (!$this->synonymes->contains($synonyme)) {
            $this->synonymes[] = $synonyme;
            $synonyme->setSynonyme($this);
        }

        return $this;
    }

    public function removeSynonyme(self $synonyme): self
    {
        if ($this->synonymes->removeElement($synonyme)) {
            // set the owning side to null (unless already changed)
            if ($synonyme->getSynonyme() === $this) {
                $synonyme->setSynonyme(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Interets[]
     */
    public function getInterets(): Collection
    {
        return $this->interets;
    }

    public function addInteret(Interets $interet): self
    {
        if (!$this->interets->contains($interet)) {
            $this->interets[] = $interet;
            $interet->addMetier($this);
        }

        return $this;
    }

    public function removeInteret(Interets $interet): self
    {
        if ($this->interets->removeElement($interet)) {
            $interet->removeMetier($this);
        }

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getSameAs(): Collection
    {
        return $this->same_as;
    }

    public function addSameAs(self $sameAs): self
    {
        if (!$this->same_as->contains($sameAs)) {
            $this->same_as[] = $sameAs;
        }

        return $this;
    }

    public function removeSameAs(self $sameAs): self
    {
        $this->same_as->removeElement($sameAs);

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
            $annonce->setMetier($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getMetier() === $this) {
                $annonce->setMetier(null);
            }
        }

        return $this;
    }
}
