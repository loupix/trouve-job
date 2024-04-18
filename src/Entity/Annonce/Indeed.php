<?php

namespace App\Entity\Annonce;

use App\Entity\Annonce\Indeed\Category;
use App\Entity\Annonce\Indeed\Company;
use App\Entity\Annonce\Indeed\Locality;
use App\Entity\Annonce\Indeed\Publisher;
use App\Repository\Annonce\IndeedRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_indeed")
 * @ORM\Entity(repositoryClass=IndeedRepository::class)
 */
class Indeed
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\ManyToOne(targetEntity=Publisher::class, inversedBy="Annonces")
     */
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $title;

    /**
     * @ORM\Column(type="datetime")
     */
    private $date;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $referencenumber;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $url;

    /**
     * @ORM\ManyToOne(targetEntity=Company::class, inversedBy="Annonces")
     */
    private $company;

    /**
     * @ORM\ManyToOne(targetEntity=Locality::class, inversedBy="Annonces")
     */
    private $locality;

    /**
     * @ORM\Column(type="text")
     */
    private $description;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $salary;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $education;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $jobtype;

    /**
     * @ORM\ManyToMany(targetEntity=Category::class, mappedBy="Annonces")
     * @ORM\JoinTable(name="annonces_indeed_annonces_categories")
     */
    private $categories;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $experience;

    /**
     * @ORM\Column(type="date", nullable=true)
     */
    private $expirationdate;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $tracking_url;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastactivitydate;

    public function __construct()
    {
        $this->categories = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getPublisher(): ?Publisher
    {
        return $this->publisher;
    }

    public function setPublisher(?Publisher $publisher): self
    {
        $this->publisher = $publisher;

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

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getReferencenumber(): ?string
    {
        return $this->referencenumber;
    }

    public function setReferencenumber(string $referencenumber): self
    {
        $this->referencenumber = $referencenumber;

        return $this;
    }

    public function getUrl(): ?string
    {
        return $this->url;
    }

    public function setUrl(string $url): self
    {
        $this->url = $url;

        return $this;
    }

    public function getCompany(): ?Company
    {
        return $this->company;
    }

    public function setCompany(?Company $company): self
    {
        $this->company = $company;

        return $this;
    }

    public function getLocality(): ?Locality
    {
        return $this->locality;
    }

    public function setLocality(?Locality $locality): self
    {
        $this->locality = $locality;

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

    public function getSalary(): ?string
    {
        return $this->salary;
    }

    public function setSalary(?string $salary): self
    {
        $this->salary = $salary;

        return $this;
    }

    public function getEducation(): ?string
    {
        return $this->education;
    }

    public function setEducation(?string $education): self
    {
        $this->education = $education;

        return $this;
    }

    public function getJobtype(): ?string
    {
        return $this->jobtype;
    }

    public function setJobtype(?string $jobtype): self
    {
        $this->jobtype = $jobtype;

        return $this;
    }

    /**
     * @return Collection|Category[]
     */
    public function getCategories(): Collection
    {
        return $this->categories;
    }

    public function addCategory(Category $category): self
    {
        if (!$this->categories->contains($category)) {
            $this->categories[] = $category;
            $category->addAnnonce($this);
        }

        return $this;
    }

    public function removeCategory(Category $category): self
    {
        if ($this->categories->removeElement($category)) {
            $category->removeAnnonce($this);
        }

        return $this;
    }

    public function getExperience(): ?string
    {
        return $this->experience;
    }

    public function setExperience(?string $experience): self
    {
        $this->experience = $experience;

        return $this;
    }

    public function getExpirationdate(): ?\DateTimeInterface
    {
        return $this->expirationdate;
    }

    public function setExpirationdate(?\DateTimeInterface $expirationdate): self
    {
        $this->expirationdate = $expirationdate;

        return $this;
    }

    public function getTrackingUrl(): ?string
    {
        return $this->tracking_url;
    }

    public function setTrackingUrl(?string $tracking_url): self
    {
        $this->tracking_url = $tracking_url;

        return $this;
    }

    public function getLastactivitydate(): ?\DateTimeInterface
    {
        return $this->lastactivitydate;
    }

    public function setLastactivitydate(?\DateTimeInterface $lastactivitydate): self
    {
        $this->lastactivitydate = $lastactivitydate;

        return $this;
    }
}
