<?php

namespace App\Repository\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi\typeContrat;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method typeContrat|null find($id, $lockMode = null, $lockVersion = null)
 * @method typeContrat|null findOneBy(array $criteria, array $orderBy = null)
 * @method typeContrat[]    findAll()
 * @method typeContrat[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class typeContratRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, typeContrat::class);
    }

    // /**
    //  * @return typeContrat[] Returns an array of typeContrat objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('t.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?typeContrat
    {
        return $this->createQueryBuilder('t')
            ->andWhere('t.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
