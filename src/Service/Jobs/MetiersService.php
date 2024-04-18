<?php

// src/Service/MetiersService.php
namespace App\Service;

use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Security\Core\Security;

use App\Entity\Jobs\Metiers;
use App\Repository\Jobs\MetiersRepository;

class MetiersService
{

	private $em;

	public function __construct(EntityManagerInterface $em) {
        $this->em = $em;
    }

	/**
     * @return Collection|Metiers[]
     */
	public function getAll(): Collection
	{
		return $this->em->getRepository(Metiers::class)->findAll();
	}


	/**
     * @return Collection|Metiers[]
     */
	public function getMe(Security $security): Collection
	{
		$user = $security->getUser();
		return $user->getSecteurs();
	}

}

?>