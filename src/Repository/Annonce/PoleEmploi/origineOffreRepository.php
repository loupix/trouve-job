<?php

namespace App\Repository\Annonce\PoleEmploi;

use App\Entity\Annonce\PoleEmploi\origineOffre;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method origineOffre|null find($id, $lockMode = null, $lockVersion = null)
 * @method origineOffre|null findOneBy(array $criteria, array $orderBy = null)
 * @method origineOffre[]    findAll()
 * @method origineOffre[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class origineOffreRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, origineOffre::class);
    }

    // /**
    //  * @return origineOffre[] Returns an array of origineOffre objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('o.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?origineOffre
    {
        return $this->createQueryBuilder('o')
            ->andWhere('o.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
