<?php

namespace App\Entity\Jobs;

use App\Entity\Annonce;
use App\Repository\Jobs\SecteursRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jobs_secteurs")
 * @ORM\Entity(repositoryClass=SecteursRepository::class)
 */
class Secteurs
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
    private $nom;

    /**
     * @ORM\OneToMany(targetEntity=Metiers::class, mappedBy="secteur")
     */
    private $metiers;

    /**
     * @ORM\ManyToOne(targetEntity=Secteurs::class, inversedBy="childs")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Secteurs::class, mappedBy="parent")
     */
    private $childs;

    /**
     * @ORM\ManyToMany(targetEntity=Annonce::class, mappedBy="Secteurs")
     * @ORM\JoinTable(name="annonces_jobs_secteurs")
     */
    private $annonces;

    public function __construct()
    {
        $this->metiers = new ArrayCollection();
        $this->childs = new ArrayCollection();
        $this->annonces = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    /**
     * @return Collection|Metiers[]
     */
    public function getMetiers(): Collection
    {
        return $this->metiers;
    }

    public function addMetier(Metiers $metier): self
    {
        if (!$this->metiers->contains($metier)) {
            $this->metiers[] = $metier;
            $metier->setSecteur($this);
        }

        return $this;
    }

    public function removeMetier(Metiers $metier): self
    {
        if ($this->metiers->removeElement($metier)) {
            // set the owning side to null (unless already changed)
            if ($metier->getSecteur() === $this) {
                $metier->setSecteur(null);
            }
        }

        return $this;
    }

    public function getParent(): ?self
    {
        return $this->parent;
    }

    public function setParent(?self $parent): self
    {
        $this->parent = $parent;

        return $this;
    }

    /**
     * @return Collection|self[]
     */
    public function getChilds(): Collection
    {
        return $this->childs;
    }

    public function addChild(self $child): self
    {
        if (!$this->childs->contains($child)) {
            $this->childs[] = $child;
            $child->setParent($this);
        }

        return $this;
    }

    public function removeChild(self $child): self
    {
        if ($this->childs->removeElement($child)) {
            // set the owning side to null (unless already changed)
            if ($child->getParent() === $this) {
                $child->setParent(null);
            }
        }

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
            $annonce->addSecteur($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            $annonce->removeSecteur($this);
        }

        return $this;
    }
}
