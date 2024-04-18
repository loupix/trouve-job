<?php

namespace App\Entity\Annonce\Indeed;

use App\Entity\Annonce\Indeed;
use App\Repository\Annonce\Indeed\PublisherRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_indeed_publisher")
 * @ORM\Entity(repositoryClass=PublisherRepository::class)
 */
class Publisher
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
    private $publisher;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $publisherurl;

    /**
     * @ORM\Column(type="datetime")
     */
    private $lastBuildDate;

    /**
     * @ORM\OneToMany(targetEntity=Indeed::class, mappedBy="publisher")
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

    public function getPublisher(): ?string
    {
        return $this->publisher;
    }

    public function setPublisher(string $publisher): self
    {
        $this->publisher = $publisher;

        return $this;
    }

    public function getPublisherurl(): ?string
    {
        return $this->publisherurl;
    }

    public function setPublisherurl(string $publisherurl): self
    {
        $this->publisherurl = $publisherurl;

        return $this;
    }

    public function getLastBuildDate(): ?\DateTimeInterface
    {
        return $this->lastBuildDate;
    }

    public function setLastBuildDate(\DateTimeInterface $lastBuildDate): self
    {
        $this->lastBuildDate = $lastBuildDate;

        return $this;
    }

    /**
     * @return Collection|Indeed[]
     */
    public function getAnnonces(): Collection
    {
        return $this->Annonces;
    }

    public function addAnnonce(Indeed $annonce): self
    {
        if (!$this->Annonces->contains($annonce)) {
            $this->Annonces[] = $annonce;
            $annonce->setPublisher($this);
        }

        return $this;
    }

    public function removeAnnonce(Indeed $annonce): self
    {
        if ($this->Annonces->removeElement($annonce)) {
            // set the owning side to null (unless already changed)
            if ($annonce->getPublisher() === $this) {
                $annonce->setPublisher(null);
            }
        }

        return $this;
    }
}
