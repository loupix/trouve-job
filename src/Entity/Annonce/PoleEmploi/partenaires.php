<?php

namespace App\Entity\Annonce\PoleEmploi;

use App\Repository\Annonce\PoleEmploi\partenairesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi_origine_offre_partenaire")
 * @ORM\Entity(repositoryClass=partenairesRepository::class)
 */
class partenaires
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
    private $nom;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $url;

    /**
     * @ORM\Column(type="binary", nullable=true)
     */
    private $logo;

    /**
     * @ORM\ManyToOne(targetEntity=origineOffre::class, inversedBy="partenaires")
     * @ORM\JoinColumn(nullable=false)
     */
    private $origineOffre;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(?string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getLogo()
    {
        return $this->logo;
    }

    public function setLogo($logo): self
    {
        $this->logo = $logo;

        return $this;
    }

    public function getOrigineOffre(): ?origineOffre
    {
        return $this->origineOffre;
    }

    public function setOrigineOffre(?origineOffre $origineOffre): self
    {
        $this->origineOffre = $origineOffre;

        return $this;
    }
}
