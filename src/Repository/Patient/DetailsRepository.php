<?php

namespace App\Repository\Patient;

use App\Entity\Patient\Details;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Details|null find($id, $lockMode = null, $lockVersion = null)
 * @method Details|null findOneBy(array $criteria, array $orderBy = null)
 * @method Details[]    findAll()
 * @method Details[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class DetailsRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Details::class);
    }

    /**
     * @param Details $details
     * @return bool
     * @throws ORMException
     */
    public function insert(Details $details): bool
    {
        try {
            $this->_em->persist($details);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }

    // /**
    //  * @return Details[] Returns an array of Details objects
    //  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('d.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Details
    {
        return $this->createQueryBuilder('d')
            ->andWhere('d.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
