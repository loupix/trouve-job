<?php

namespace App\Entity\Jobs;

use App\Repository\Jobs\InteretsRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="jobs_interets")
 * @ORM\Entity(repositoryClass=InteretsRepository::class)
 */
class Interets
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
     * @ORM\ManyToMany(targetEntity=Metiers::class, inversedBy="interets")
     * @ORM\JoinTable(name="jobs_interets_metiers")
     */
    private $Metiers;

    public function __construct()
    {
        $this->Metiers = new ArrayCollection();
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
}
