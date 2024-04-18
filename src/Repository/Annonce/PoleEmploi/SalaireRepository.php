<?php

namespace App\Repository\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi\Salaire;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Salaire|null find($id, $lockMode = null, $lockVersion = null)
 * @method Salaire|null findOneBy(array $criteria, array $orderBy = null)
 * @method Salaire[]    findAll()
 * @method Salaire[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class SalaireRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Salaire::class);
    }

    // /**
    //  * @return Salaire[] Returns an array of Salaire objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('s.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Salaire
    {
        return $this->createQueryBuilder('s')
            ->andWhere('s.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
