<?php

namespace App\Entity\User;

use App\Entity\Visitor\Entreprise\Follow;
use App\Entity\Visitor\Information;
use App\Entity\Visitor\Jobs\Hover;
use App\Entity\Visitor\Jobs\Show;
use App\Entity\Visitor\Location;
use App\Repository\User\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;
use Symfony\Component\Uid\Uuid;
use Symfony\Bridge\Doctrine\IdGenerator\UlidGenerator;
use Symfony\Component\Uid\Ulid;

/**
 * @ORM\Entity()
 * @ORM\InheritanceType("JOINED")
 * @ORM\DiscriminatorColumn(name="type", type="string")
 * @ORM\DiscriminatorMap({"visitor"="Visitor", "registered"="Registered"})
 * @UniqueEntity(fields={"uuid"}, message="There is already an account with this uuid")
 */
abstract class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    /**
     * @ORM\Id
     * @ORM\Column(type="ulid", unique=true)
     * @ORM\GeneratedValue(strategy="CUSTOM")
     * @ORM\CustomIdGenerator(class=UlidGenerator::class)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=180, unique=true)
     */
    private $uuid;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @var string The hashed password
     * @ORM\Column(type="string")
     */
    private $password;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $created_at;

    /**
     * @ORM\Column(type="datetime_immutable")
     */
    private $updated_at;

    /**
     * @ORM\ManyToOne(targetEntity=Location::class, inversedBy="users", cascade={"persist"}))
     * @ORM\JoinColumn(nullable=false)
     */
    private $Location;

    /**
     * @ORM\ManyToOne(targetEntity=Information::class, inversedBy="users", cascade={"persist"}))
     * @ORM\JoinColumn(nullable=false)
     */
    private $Information;

    /**
     * @ORM\OneToMany(targetEntity=Show::class, mappedBy="user", orphanRemoval=true)
     */
    private $JobShows;

    /**
     * @ORM\OneToMany(targetEntity=Hover::class, mappedBy="user", orphanRemoval=true)
     */
    private $JobHovers;

    /**
     * @ORM\OneToMany(targetEntity=\App\Entity\Visitor\Entreprise\Show::class, mappedBy="user", orphanRemoval=true)
     */
    private $EntrepriseShows;

    /**
     * @ORM\OneToMany(targetEntity=\App\Entity\Visitor\Entreprise\Hover::class, mappedBy="user", orphanRemoval=true)
     */
    private $EntrepriseHover;

    /**
     * @ORM\OneToMany(targetEntity=Follow::class, mappedBy="user")
     */
    private $EntrepriseFollow;

    public function __construct(){
        $this->setUuid(Uuid::v4());
        $this->setCreatedAt(new \DateTimeImmutable());
        $this->setUpdatedAt(new \DateTimeImmutable());
        $this->JobShows = new ArrayCollection();
        $this->JobHovers = new ArrayCollection();
        $this->EntrepriseShows = new ArrayCollection();
        $this->EntrepriseHover = new ArrayCollection();
        $this->EntrepriseFollow = new ArrayCollection();
    }

    public function getId(): ?string
    {
        return $this->id;
    }

    public function getUuid(): ?string
    {
        return $this->uuid;
    }

    public function setUuid(string $uuid): self
    {
        $this->uuid = $uuid;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @deprecated since Symfony 5.3, use getUserIdentifier instead
     */
    public function getUsername(): string
    {
        return (string) $this->uuid;
    }

    /**
     * @see UserInterface
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    public function setRoles(array $roles): self
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    public function setPassword(string $password): self
    {
        $this->password = $password;

        return $this;
    }

    /**
     * Returning a salt is only needed, if you are not using a modern
     * hashing algorithm (e.g. bcrypt or sodium) in your security.yaml.
     *
     * @see UserInterface
     */
    public function getSalt(): ?string
    {
        return null;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials()
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getCreatedAt(): ?\DateTimeImmutable
    {
        return $this->created_at;
    }

    public function setCreatedAt(\DateTimeImmutable $created_at): self
    {
        $this->created_at = $created_at;

        return $this;
    }

    public function getUpdatedAt(): ?\DateTimeImmutable
    {
        return $this->updated_at;
    }

    public function setUpdatedAt(\DateTimeImmutable $updated_at): self
    {
        $this->updated_at = $updated_at;

        return $this;
    }

    public function getLocation(): ?Location
    {
        return $this->Location;
    }

    public function setLocation(?Location $Location): self
    {
        $this->Location = $Location;

        return $this;
    }

    public function getInformation(): ?Information
    {
        return $this->Information;
    }

    public function setInformation(?Information $Information): self
    {
        $this->Information = $Information;

        return $this;
    }

    /**
     * @return Collection|Show[]
     */
    public function getJobShows(): Collection
    {
        return $this->JobShows;
    }

    public function addJobShow(Show $jobShow): self
    {
        if (!$this->JobShows->contains($jobShow)) {
            $this->JobShows[] = $jobShow;
            $jobShow->setUser($this);
        }

        return $this;
    }

    public function removeJobShow(Show $jobShow): self
    {
        if ($this->JobShows->removeElement($jobShow)) {
            // set the owning side to null (unless already changed)
            if ($jobShow->getUser() === $this) {
                $jobShow->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Hover[]
     */
    public function getJobHovers(): Collection
    {
        return $this->JobHovers;
    }

    public function addJobHover(Hover $jobHover): self
    {
        if (!$this->JobHovers->contains($jobHover)) {
            $this->JobHovers[] = $jobHover;
            $jobHover->setUser($this);
        }

        return $this;
    }

    public function removeJobHover(Hover $jobHover): self
    {
        if ($this->JobHovers->removeElement($jobHover)) {
            // set the owning side to null (unless already changed)
            if ($jobHover->getUser() === $this) {
                $jobHover->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|\App\Entity\Visitor\Entreprise\Show[]
     */
    public function getEntrepriseShows(): Collection
    {
        return $this->EntrepriseShows;
    }

    public function addEntrepriseShow(\App\Entity\Visitor\Entreprise\Show $entrepriseShow): self
    {
        if (!$this->EntrepriseShows->contains($entrepriseShow)) {
            $this->EntrepriseShows[] = $entrepriseShow;
            $entrepriseShow->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseShow(\App\Entity\Visitor\Entreprise\Show $entrepriseShow): self
    {
        if ($this->EntrepriseShows->removeElement($entrepriseShow)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseShow->getUser() === $this) {
                $entrepriseShow->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|\App\Entity\Visitor\Entreprise\Hover[]
     */
    public function getEntrepriseHover(): Collection
    {
        return $this->EntrepriseHover;
    }

    public function addEntrepriseHover(\App\Entity\Visitor\Entreprise\Hover $entrepriseHover): self
    {
        if (!$this->EntrepriseHover->contains($entrepriseHover)) {
            $this->EntrepriseHover[] = $entrepriseHover;
            $entrepriseHover->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseHover(\App\Entity\Visitor\Entreprise\Hover $entrepriseHover): self
    {
        if ($this->EntrepriseHover->removeElement($entrepriseHover)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseHover->getUser() === $this) {
                $entrepriseHover->setUser(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Follow[]
     */
    public function getEntrepriseFollow(): Collection
    {
        return $this->EntrepriseFollow;
    }

    public function addEntrepriseFollow(Follow $entrepriseFollow): self
    {
        if (!$this->EntrepriseFollow->contains($entrepriseFollow)) {
            $this->EntrepriseFollow[] = $entrepriseFollow;
            $entrepriseFollow->setUser($this);
        }

        return $this;
    }

    public function removeEntrepriseFollow(Follow $entrepriseFollow): self
    {
        if ($this->EntrepriseFollow->removeElement($entrepriseFollow)) {
            // set the owning side to null (unless already changed)
            if ($entrepriseFollow->getUser() === $this) {
                $entrepriseFollow->setUser(null);
            }
        }

        return $this;
    }
}
