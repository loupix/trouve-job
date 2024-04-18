<?php

// src/Service/SecteursService.php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

use App\Entity\Jobs\Secteurs;
use App\Repository\Jobs\SecteursRepository;

class SecteursService
{

	private $em;

	public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

	/**
     * @return Collection|Secteurs[]
     */
	public function getAll(): Collection
	{
		return $this->em->getRepository(Secteurs::class)->findAll();
	}


	/**
     * @return Collection|Secteurs[]
     */
	public function getMe(Security $security): Collection
	{
		$user = $security->getUser();
		return $user->getSecteurs();
	}


	/**
     * @return Array|Secteurs[]
     */
	public function toArray(Collection $secteurs): Array
	{
		return array_map(function($s){
			return Array(
				"id"=>$s->getId(),
				"nom"=>$s->getNom(),
			);
		}, $secteurs);
	}



	/**
     * @return String|Icons[]
     */
	public function getIcons(): Array
	{
		return Array(
			"Agriculture - Paysage" => "fas fa-tractor",
			"Alimentation - Agroalimentaire" => "fas fa-ustensils",
			"Animaux" => "fas fa-paw",
			"Architecture - Décoration" => "fas fa-laptop-house",
			"Armée – Sécurité - Secours" => "fas fa-user-shield",
			"Artisanat d’art – Design - Mode" => "fas fa-icons",
			"Banque - Finance - Assurance" => "fas fa-donate",
			"Biologie - Chimie" => "fas fa-microscope",
			"BTP - Urbanisme" => "fas fa-city",
			"Cinéma – Audiovisuel - Jeux vidéo" => "fas fa-photo-video",
			"Commerce - Immobilier" => "far fa-handshake",
			"Communication - Journalisme - Marketing" => "far fa-newspaper",
			"Culture – Spectacle- Patrimoine" => "far fa-theater-masks",
			"Droit - Justice" => "fas fa-balance-scale",
			"Edition - Imprimerie - Livre" => "fas fa-print",
			"Electricité - Electronique - Robotique" => "fas fa-microchip",
			"Energie" => "fas fa-charging-station",
			"Enseignement - Formation - Insertion" => "fas fa-chalkboard-teacher",
			"Environnement – Eau – Déchets - Propreté" => "fas fa-envira",
			"Gestion – Comptabilité - RH" => "fas fa-chat-pie",
			"Hôtellerie - Restauration - Tourisme" => "fas fa-concierge-bell",
			"Humanitaire" => "fas fa-dove",
			"Informatique - Web - Réseaux" => "fas fa-latop-code",
			"Lettres - Sciences humaines - Langues" => "fas fa-graduation-cap",
			"Matériaux - Industrie" => "fas fa-industry",
			"Mécanique - Automobile" => "fas fa-truck-monster",
			"Santé - Paramédical" => "fas fa-medkit",
			"Sciences Physique – Maths - Data" => "fas fa-square-root-alt",
			"Secrétariat - Accueil" => "fas fa-users",
			"Social - Petite enfance - Services à la personne" => "fas fa-chid",
			"Soins - Esthétique - Coiffure" => "fas fa-hair-freshener",
			"Sport - Animation" => "fas fa-volleyball-ball",
			"Transport - Logistique" => "fas fa-dolly"
		);
	}


	/**
     * @return String|Icons[]
     */
	public function setIcons(Collection $secteurs): Array
	{
		return Array();
	}

}

?>