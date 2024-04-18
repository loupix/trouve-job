<?php

namespace App\Repository\Jobs;

use App\Entity\Jobs\Etudes;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Etudes|null find($id, $lockMode = null, $lockVersion = null)
 * @method Etudes|null findOneBy(array $criteria, array $orderBy = null)
 * @method Etudes[]    findAll()
 * @method Etudes[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class EtudesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Etudes::class);
    }

    // /**
    //  * @return Etudes[] Returns an array of Etudes objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('e.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Etudes
    {
        return $this->createQueryBuilder('e')
            ->andWhere('e.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
