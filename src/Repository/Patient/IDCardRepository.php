<?php

namespace App\Repository\Patient;

use App\Entity\Patient\IDCard;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method IDCard|null find($id, $lockMode = null, $lockVersion = null)
 * @method IDCard|null findOneBy(array $criteria, array $orderBy = null)
 * @method IDCard[]    findAll()
 * @method IDCard[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class IDCardRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, IDCard::class);
    }

    /**
     * @param IDCard $IDCard
     * @return bool
     * @throws ORMException
     */
    public function insert(IDCard $IDCard): bool
    {
        try {
            $this->_em->persist($IDCard);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }



    // /**
    //  * @return IDCard[] Returns an array of IDCard objects
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
    public function findOneBySomeField($value): ?IDCard
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
