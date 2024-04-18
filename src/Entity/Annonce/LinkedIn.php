<?php

namespace App\Entity\Annonce;

use App\Entity\Annonce\Linkedin\Location;
use App\Entity\Annonce\Linkedin\industryCode;
use App\Entity\Annonce\Linkedin\jobFunctions;
use App\Repository\Annonce\LinkedinRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_linkedin")
 * @ORM\Entity(repositoryClass=LinkedinRepository::class)
 */
class LinkedIn
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
    private $partnerJobId;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="Annonces")
     */
    private $location;

    /**
     * @ORM\ManyToMany(targetEntity=industryCode::class, mappedBy="Annonces")
     * @ORM\JoinTable(name="annonces_linkedin_annonces_industry_code")
     */
    private $industryCodes;

    /**
     * @ORM\ManyToMany(targetEntity=jobFunctions::class, mappedBy="Annonces")
     */
    private $jobFunctions;

    public function __construct()
    {
        $this->industryCodes = new ArrayCollection();
        $this->jobFunctions = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPartnerJobId(): ?int
    {
        return $this->partnerJobId;
    }

    public function setPartnerJobId(int $partnerJobId): self
    {
        $this->partnerJobId = $partnerJobId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): self
    {
        $this->title = $title;

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

    public function getLocation(): ?Location
    {
        return $this->location;
    }

    public function setLocation(?Location $location): self
    {
        $this->location = $location;

        return $this;
    }

    /**
     * @return Collection|industryCode[]
     */
    public function getIndustryCodes(): Collection
    {
        return $this->industryCodes;
    }

    public function addIndustryCode(industryCode $industryCode): self
    {
        if (!$this->industryCodes->contains($industryCode)) {
            $this->industryCodes[] = $industryCode;
            $industryCode->addAnnonce($this);
        }

        return $this;
    }

    public function removeIndustryCode(industryCode $industryCode): self
    {
        if ($this->industryCodes->removeElement($industryCode)) {
            $industryCode->removeAnnonce($this);
        }

        return $this;
    }

    /**
     * @return Collection|jobFunctions[]
     */
    public function getJobFunctions(): Collection
    {
        return $this->jobFunctions;
    }

    public function addJobFunction(jobFunctions $jobFunction): self
    {
        if (!$this->jobFunctions->contains($jobFunction)) {
            $this->jobFunctions[] = $jobFunction;
            $jobFunction->addAnnonce($this);
        }

        return $this;
    }

    public function removeJobFunction(jobFunctions $jobFunction): self
    {
        if ($this->jobFunctions->removeElement($jobFunction)) {
            $jobFunction->removeAnnonce($this);
        }

        return $this;
    }
}
