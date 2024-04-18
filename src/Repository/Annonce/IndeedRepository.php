<?php

namespace App\Repository\Annonce;

use App\Entity\Annonce\Indeed;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Indeed|null find($id, $lockMode = null, $lockVersion = null)
 * @method Indeed|null findOneBy(array $criteria, array $orderBy = null)
 * @method Indeed[]    findAll()
 * @method Indeed[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IndeedRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Indeed::class);
    }

    // /**
    //  * @return Indeed[] Returns an array of Indeed objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('i.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Indeed
    {
        return $this->createQueryBuilder('i')
            ->andWhere('i.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
