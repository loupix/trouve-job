<?php

namespace App\Repository\Visitor\Entreprise;

use App\Entity\Visitor\Entreprise\Hover;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Hover|null find($id, $lockMode = null, $lockVersion = null)
 * @method Hover|null findOneBy(array $criteria, array $orderBy = null)
 * @method Hover[]    findAll()
 * @method Hover[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class HoverRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Hover::class);
    }

    // /**
    //  * @return Hover[] Returns an array of Hover objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('h.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Hover
    {
        return $this->createQueryBuilder('h')
            ->andWhere('h.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
