<?php

namespace App\Entity\Annonce;

use App\Entity\Annonce\PoleEmploi\Agence;
use App\Entity\Annonce\PoleEmploi\Competences;
use App\Entity\Annonce\PoleEmploi\Contact;
use App\Entity\Annonce\PoleEmploi\Entreprise;
use App\Entity\Annonce\PoleEmploi\Formations;
use App\Entity\Annonce\PoleEmploi\Langues;
use App\Entity\Annonce\PoleEmploi\Salaire;
use App\Entity\Annonce\PoleEmploi\lieuTravail;
use App\Entity\Annonce\PoleEmploi\origineOffre;
use App\Entity\Annonce\PoleEmploi\permis;
use App\Repository\Annonce\PoleEmploiRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Table(name="annonces_pole_emploi")
 * @ORM\Entity(repositoryClass=PoleEmploiRepository::class)
 */
class PoleEmploi
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=7)
     */
    private $identifiant;

    /**
     * @ORM\Column(type="string", length=300)
     */
    private $intitule;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime")
     */
    private $dateCreation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $dateActualisation;

    /**
     * @ORM\Column(type="string", length=5, nullable=true)
     */
    private $romeCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $romeLibelle;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $appellationLibelle;

    /**
     * @ORM\Column(type="boolean")
     */
    private $offresManqueCandidats;

    /**
     * @ORM\Column(type="string", length=1)
     */
    private $experienceExige;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $experienceLibelle;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $experienceCommentaire;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $outilsBureautiques;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dureeTravailLibelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $dureeTravailLibelleConverti;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $complementExercice;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $conditionExercice;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $alternance;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $nombrePostes;

    /**
     * @ORM\Column(type="boolean", nullable=true)
     */
    private $accessibleTH;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deplacementCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $deplacementLibelle;

    /**
     * @ORM\Column(type="string", length=1, nullable=true)
     */
    private $qualificationCode;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $qualificationLibelle;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secteurActivite;

    /**
     * @ORM\Column(type="string", length=255, nullable=true)
     */
    private $secteurActiviteLibelle;

    /**
     * @ORM\ManyToOne(targetEntity=lieuTravail::class, inversedBy="Annonces")
     */
    private $lieuTravail;

    /**
     * @ORM\ManyToOne(targetEntity=Entreprise::class, inversedBy="Annonces")
     */
    private $entreprise;

    /**
     * @ORM\ManyToOne(targetEntity=origineOffre::class, inversedBy="Annonces")
     */
    private $origineOffre;

    /**
     * @ORM\ManyToOne(targetEntity=Formations::class, inversedBy="Annonces")
     */
    private $formations;

    /**
     * @ORM\ManyToOne(targetEntity=Langues::class, inversedBy="Annonces")
     */
    private $langues;

    /**
     * @ORM\ManyToOne(targetEntity=permis::class, inversedBy="Annonces")
     */
    private $permis;

    /**
     * @ORM\ManyToOne(targetEntity=Competences::class, inversedBy="Annonces")
     */
    private $competences;

    /**
     * @ORM\ManyToOne(targetEntity=Salaire::class, inversedBy="Annonces")
     */
    private $salaire;

    /**
     * @ORM\ManyToOne(targetEntity=Contact::class, inversedBy="Annonces")
     */
    private $contact;

    /**
     * @ORM\ManyToOne(targetEntity=Agence::class, inversedBy="Annonces")
     */
    private $agence;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdentifiant(): ?string
    {
        return $this->identifiant;
    }

    public function setIdentifiant(string $identifiant): self
    {
        $this->identifiant = $identifiant;

        return $this;
    }

    public function getIntitule(): ?string
    {
        return $this->intitule;
    }

    public function setIntitule(string $intitule): self
    {
        $this->intitule = $intitule;

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

    public function getDateCreation(): ?\DateTimeInterface
    {
        return $this->dateCreation;
    }

    public function setDateCreation(\DateTimeInterface $dateCreation): self
    {
        $this->dateCreation = $dateCreation;

        return $this;
    }

    public function getDateActualisation(): ?\DateTimeInterface
    {
        return $this->dateActualisation;
    }

    public function setDateActualisation(?\DateTimeInterface $dateActualisation): self
    {
        $this->dateActualisation = $dateActualisation;

        return $this;
    }

    public function getRomeCode(): ?string
    {
        return $this->romeCode;
    }

    public function setRomeCode(?string $romeCode): self
    {
        $this->romeCode = $romeCode;

        return $this;
    }

    public function getRomeLibelle(): ?string
    {
        return $this->romeLibelle;
    }

    public function setRomeLibelle(?string $romeLibelle): self
    {
        $this->romeLibelle = $romeLibelle;

        return $this;
    }

    public function getAppellationLibelle(): ?string
    {
        return $this->appellationLibelle;
    }

    public function setAppellationLibelle(string $appellationLibelle): self
    {
        $this->appellationLibelle = $appellationLibelle;

        return $this;
    }

    public function getOffresManqueCandidats(): ?bool
    {
        return $this->offresManqueCandidats;
    }

    public function setOffresManqueCandidats(bool $offresManqueCandidats): self
    {
        $this->offresManqueCandidats = $offresManqueCandidats;

        return $this;
    }

    public function getExperienceExige(): ?string
    {
        return $this->experienceExige;
    }

    public function setExperienceExige(string $experienceExige): self
    {
        $this->experienceExige = $experienceExige;

        return $this;
    }

    public function getExperienceLibelle(): ?string
    {
        return $this->experienceLibelle;
    }

    public function setExperienceLibelle(?string $experienceLibelle): self
    {
        $this->experienceLibelle = $experienceLibelle;

        return $this;
    }

    public function getExperienceCommentaire(): ?string
    {
        return $this->experienceCommentaire;
    }

    public function setExperienceCommentaire(?string $experienceCommentaire): self
    {
        $this->experienceCommentaire = $experienceCommentaire;

        return $this;
    }

    public function getOutilsBureautiques(): ?string
    {
        return $this->outilsBureautiques;
    }

    public function setOutilsBureautiques(?string $outilsBureautiques): self
    {
        $this->outilsBureautiques = $outilsBureautiques;

        return $this;
    }

    public function getDureeTravailLibelle(): ?string
    {
        return $this->dureeTravailLibelle;
    }

    public function setDureeTravailLibelle(?string $dureeTravailLibelle): self
    {
        $this->dureeTravailLibelle = $dureeTravailLibelle;

        return $this;
    }

    public function getDureeTravailLibelleConverti(): ?string
    {
        return $this->dureeTravailLibelleConverti;
    }

    public function setDureeTravailLibelleConverti(?string $dureeTravailLibelleConverti): self
    {
        $this->dureeTravailLibelleConverti = $dureeTravailLibelleConverti;

        return $this;
    }

    public function getComplementExercice(): ?string
    {
        return $this->complementExercice;
    }

    public function setComplementExercice(?string $complementExercice): self
    {
        $this->complementExercice = $complementExercice;

        return $this;
    }

    public function getConditionExercice(): ?string
    {
        return $this->conditionExercice;
    }

    public function setConditionExercice(?string $conditionExercice): self
    {
        $this->conditionExercice = $conditionExercice;

        return $this;
    }

    public function getAlternance(): ?bool
    {
        return $this->alternance;
    }

    public function setAlternance(?bool $alternance): self
    {
        $this->alternance = $alternance;

        return $this;
    }

    public function getNombrePostes(): ?int
    {
        return $this->nombrePostes;
    }

    public function setNombrePostes(?int $nombrePostes): self
    {
        $this->nombrePostes = $nombrePostes;

        return $this;
    }

    public function getAccessibleTH(): ?bool
    {
        return $this->accessibleTH;
    }

    public function setAccessibleTH(?bool $accessibleTH): self
    {
        $this->accessibleTH = $accessibleTH;

        return $this;
    }

    public function getDeplacementCode(): ?string
    {
        return $this->deplacementCode;
    }

    public function setDeplacementCode(?string $deplacementCode): self
    {
        $this->deplacementCode = $deplacementCode;

        return $this;
    }

    public function getDeplacementLibelle(): ?string
    {
        return $this->deplacementLibelle;
    }

    public function setDeplacementLibelle(?string $deplacementLibelle): self
    {
        $this->deplacementLibelle = $deplacementLibelle;

        return $this;
    }

    public function getQualificationCode(): ?string
    {
        return $this->qualificationCode;
    }

    public function setQualificationCode(?string $qualificationCode): self
    {
        $this->qualificationCode = $qualificationCode;

        return $this;
    }

    public function getQualificationLibelle(): ?string
    {
        return $this->qualificationLibelle;
    }

    public function setQualificationLibelle(?string $qualificationLibelle): self
    {
        $this->qualificationLibelle = $qualificationLibelle;

        return $this;
    }

    public function getSecteurActivite(): ?string
    {
        return $this->secteurActivite;
    }

    public function setSecteurActivite(?string $secteurActivite): self
    {
        $this->secteurActivite = $secteurActivite;

        return $this;
    }

    public function getSecteurActiviteLibelle(): ?string
    {
        return $this->secteurActiviteLibelle;
    }

    public function setSecteurActiviteLibelle(?string $secteurActiviteLibelle): self
    {
        $this->secteurActiviteLibelle = $secteurActiviteLibelle;

        return $this;
    }

    public function getLieuTravail(): ?lieuTravail
    {
        return $this->lieuTravail;
    }

    public function setLieuTravail(?lieuTravail $lieuTravail): self
    {
        $this->lieuTravail = $lieuTravail;

        return $this;
    }

    public function getEntreprise(): ?Entreprise
    {
        return $this->entreprise;
    }

    public function setEntreprise(?Entreprise $entreprise): self
    {
        $this->entreprise = $entreprise;

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

    public function getFormations(): ?Formations
    {
        return $this->formations;
    }

    public function setFormations(?Formations $formations): self
    {
        $this->formations = $formations;

        return $this;
    }

    public function getLangues(): ?Langues
    {
        return $this->langues;
    }

    public function setLangues(?Langues $langues): self
    {
        $this->langues = $langues;

        return $this;
    }

    public function getPermis(): ?permis
    {
        return $this->permis;
    }

    public function setPermis(?permis $permis): self
    {
        $this->permis = $permis;

        return $this;
    }

    public function getCompetences(): ?Competences
    {
        return $this->competences;
    }

    public function setCompetences(?Competences $competences): self
    {
        $this->competences = $competences;

        return $this;
    }

    public function getSalaire(): ?Salaire
    {
        return $this->salaire;
    }

    public function setSalaire(?Salaire $salaire): self
    {
        $this->salaire = $salaire;

        return $this;
    }

    public function getContact(): ?Contact
    {
        return $this->contact;
    }

    public function setContact(?Contact $contact): self
    {
        $this->contact = $contact;

        return $this;
    }

    public function getAgence(): ?Agence
    {
        return $this->agence;
    }

    public function setAgence(?Agence $agence): self
    {
        $this->agence = $agence;

        return $this;
    }
}
