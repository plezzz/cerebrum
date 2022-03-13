<?php

namespace App\Repository\Patient;

use App\Entity\Patient\PsychologicalEvaluationNote;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PsychologicalEvaluationNote|null find($id, $lockMode = null, $lockVersion = null)
 * @method PsychologicalEvaluationNote|null findOneBy(array $criteria, array $orderBy = null)
 * @method PsychologicalEvaluationNote[]    findAll()
 * @method PsychologicalEvaluationNote[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychologicalEvaluationNoteRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PsychologicalEvaluationNote::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PsychologicalEvaluationNote $entity, bool $flush = true): void
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
    public function remove(PsychologicalEvaluationNote $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PsychologicalEvaluationNote[] Returns an array of PsychologicalEvaluationNote objects
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
    public function findOneBySomeField($value): ?PsychologicalEvaluationNote
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
