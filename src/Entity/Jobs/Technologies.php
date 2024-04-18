<?php

namespace App\Entity\Jobs;

use App\Entity\Annonce;
use App\Repository\Jobs\TechnologiesRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jobs_technologies")
 * @ORM\Entity(repositoryClass=TechnologiesRepository::class)
 */
class Technologies
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=20)
     */
    private $nom;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $icone;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $icone_width;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $icone_height;

    /**
     * @ORM\ManyToOne(targetEntity=Technologies::class, inversedBy="childs")
     */
    private $parent;

    /**
     * @ORM\OneToMany(targetEntity=Technologies::class, mappedBy="parent")
     */
    private $childs;

    /**
     * @ORM\ManyToMany(targetEntity=Annonce::class, mappedBy="Technologies")
     * @ORM\JoinTable(name="annonces_jobs_technologies")
     */
    private $annonces;

    public function __construct()
    {
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

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function setDescription(?string $description): self
    {
        $this->description = $description;

        return $this;
    }

    public function getIcone()
    {
        return $this->icone;
    }

    public function setIcone($icone): self
    {
        $this->icone = $icone;

        return $this;
    }

    public function getIconeWidth(): ?int
    {
        return $this->icone_width;
    }

    public function setIconeWidth(int $icone_width): self
    {
        $this->icone_width = $icone_width;

        return $this;
    }

    public function getIconeHeight(): ?int
    {
        return $this->icone_height;
    }

    public function setIconeHeight(int $icone_height): self
    {
        $this->icone_height = $icone_height;

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
            $annonce->addTechnology($this);
        }

        return $this;
    }

    public function removeAnnonce(Annonce $annonce): self
    {
        if ($this->annonces->removeElement($annonce)) {
            $annonce->removeTechnology($this);
        }

        return $this;
    }
}
