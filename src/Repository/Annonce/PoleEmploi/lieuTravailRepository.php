<?php

namespace App\Repository\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi\lieuTravail;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method lieuTravail|null find($id, $lockMode = null, $lockVersion = null)
 * @method lieuTravail|null findOneBy(array $criteria, array $orderBy = null)
 * @method lieuTravail[]    findAll()
 * @method lieuTravail[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class lieuTravailRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, lieuTravail::class);
    }

    // /**
    //  * @return lieuTravail[] Returns an array of lieuTravail objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('l.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?lieuTravail
    {
        return $this->createQueryBuilder('l')
            ->andWhere('l.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
