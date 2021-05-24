<?php

namespace App\Repository\LOG;

use App\Entity\LOG\PationsEdit;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PationsEdit|null find($id, $lockMode = null, $lockVersion = null)
 * @method PationsEdit|null findOneBy(array $criteria, array $orderBy = null)
 * @method PationsEdit[]    findAll()
 * @method PationsEdit[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PationsEditRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PationsEdit::class);
    }

    // /**
    //  * @return PationsEdit[] Returns an array of PationsEdit objects
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
    public function findOneBySomeField($value): ?PationsEdit
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
