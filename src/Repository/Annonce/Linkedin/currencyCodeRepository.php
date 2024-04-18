<?php

namespace App\Repository\Annonce\Linkedin;

use App\Entity\Annonce\Linkedin\currencyCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method currencyCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method currencyCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method currencyCode[]    findAll()
 * @method currencyCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class currencyCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, currencyCode::class);
    }

    // /**
    //  * @return currencyCode[] Returns an array of currencyCode objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('c.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?currencyCode
    {
        return $this->createQueryBuilder('c')
            ->andWhere('c.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
