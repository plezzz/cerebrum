<?php

namespace App\Repository\Patient;

use App\Entity\Patient\PsychologicalEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PsychologicalEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PsychologicalEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PsychologicalEvaluation[]    findAll()
 * @method PsychologicalEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychologicalEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PsychologicalEvaluation::class);
    }

    /**
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function add(PsychologicalEvaluation $entity, bool $flush = true): void
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
    public function remove(PsychologicalEvaluation $entity, bool $flush = true): void
    {
        $this->_em->remove($entity);
        if ($flush) {
            $this->_em->flush();
        }
    }

    // /**
    //  * @return PsychologicalEvaluation[] Returns an array of PsychologicalEvaluation objects
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
    public function findOneBySomeField($value): ?PsychologicalEvaluation
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
