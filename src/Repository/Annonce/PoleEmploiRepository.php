<?php

namespace App\Repository\Annonce;

use App\Entity\Annonce\PoleEmploi;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PoleEmploi|null find($id, $lockMode = null, $lockVersion = null)
 * @method PoleEmploi|null findOneBy(array $criteria, array $orderBy = null)
 * @method PoleEmploi[]    findAll()
 * @method PoleEmploi[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PoleEmploiRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PoleEmploi::class);
    }

    // /**
    //  * @return PoleEmploi[] Returns an array of PoleEmploi objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('p.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?PoleEmploi
    {
        return $this->createQueryBuilder('p')
            ->andWhere('p.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
