<?php

namespace App\Entity\Annonce\Linkedin;

use App\Entity\Annonce\Linkedin;
use App\Repository\Annonce\Linkedin\industryCodeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_linkedin_industry_code")
 * @ORM\Entity(repositoryClass=industryCodeRepository::class)
 */
class industryCode
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $code;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $groups;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToMany(targetEntity=Linkedin::class, inversedBy="industryCodes")
     * @ORM\JoinTable(name="annonces_linkedin_annonces_industry_code")
     */
    private $Annonces;

    public function __construct()
    {
        $this->Annonces = new ArrayCollection();
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

    public function getGroups(): ?string
    {
        return $this->groups;
    }

    public function setGroups(string $groups): self
    {
        $this->groups = $groups;

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

    /**
     * @return Collection|Linkedin[]
     */
    public function getAnnonces(): Collection
    {
        return $this->Annonces;
    }

    public function addAnnonce(Linkedin $annonce): self
    {
        if (!$this->Annonces->contains($annonce)) {
            $this->Annonces[] = $annonce;
        }

        return $this;
    }

    public function removeAnnonce(Linkedin $annonce): self
    {
        $this->Annonces->removeElement($annonce);

        return $this;
    }
}
