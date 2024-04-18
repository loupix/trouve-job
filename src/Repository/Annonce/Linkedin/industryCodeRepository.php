<?php

namespace App\Repository\Annonce\Linkedin;

use App\Entity\Annonce\Linkedin\industryCode;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method industryCode|null find($id, $lockMode = null, $lockVersion = null)
 * @method industryCode|null findOneBy(array $criteria, array $orderBy = null)
 * @method industryCode[]    findAll()
 * @method industryCode[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class industryCodeRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, industryCode::class);
    }

    // /**
    //  * @return industryCode[] Returns an array of industryCode objects
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
    public function findOneBySomeField($value): ?industryCode
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
