<?php

namespace App\Repository\Patient;

use App\Entity\Patient\PsychiatricEvaluationNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PsychiatricEvaluationNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method PsychiatricEvaluationNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method PsychiatricEvaluationNote[]    findAll()
 * @method PsychiatricEvaluationNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychiatricEvaluationNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PsychiatricEvaluationNote::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PsychiatricEvaluationNote $entity, bool $flush = true): void
    {
        $this->_em->persist($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function remove(PsychiatricEvaluationNote $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PsychiatricEvaluationNote[] Returns an array of PsychiatricEvaluationNote objects
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
    public function findOneBySomeField($value): ?PsychiatricEvaluationNote
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
