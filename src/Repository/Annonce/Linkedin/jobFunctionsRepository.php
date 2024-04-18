<?php

namespace App\Repository\Annonce\Linkedin;

use App\Entity\Annonce\Linkedin\jobFunctions;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method jobFunctions|null find($id, $lockMode = null, $lockVersion = null)
 * @method jobFunctions|null findOneBy(array $criteria, array $orderBy = null)
 * @method jobFunctions[]    findAll()
 * @method jobFunctions[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class jobFunctionsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, jobFunctions::class);
    }

    // /**
    //  * @return jobFunctions[] Returns an array of jobFunctions objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('j.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?jobFunctions
    {
        return $this->createQueryBuilder('j')
            ->andWhere('j.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
