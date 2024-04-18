<?php

namespace App\Repository\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi\partenaires;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method partenaires|null find($id, $lockMode = null, $lockVersion = null)
 * @method partenaires|null findOneBy(array $criteria, array $orderBy = null)
 * @method partenaires[]    findAll()
 * @method partenaires[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class partenairesRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, partenaires::class);
    }

    // /**
    //  * @return partenaires[] Returns an array of partenaires objects
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
    public function findOneBySomeField($value): ?partenaires
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
