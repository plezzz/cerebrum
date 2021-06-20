<?php

namespace App\Repository\Patient;

use App\Entity\Patient\PsychiatricEvaluation;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method PsychiatricEvaluation|null find($id, $lockMode = null, $lockVersion = null)
 * @method PsychiatricEvaluation|null findOneBy(array $criteria, array $orderBy = null)
 * @method PsychiatricEvaluation[]    findAll()
 * @method PsychiatricEvaluation[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PsychiatricEvaluationRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, PsychiatricEvaluation::class);
    }


    /**
     * @param PsychiatricEvaluation $psychiatricEvaluation
     * @return bool
     * @throws ORMException
     */
    public function insert(PsychiatricEvaluation $psychiatricEvaluation): bool
    {
        try {
            $this->_em->persist($psychiatricEvaluation);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }
    // /**
    //  * @return PsychiatricEvaluation[] Returns an array of PsychiatricEvaluation objects
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
    public function findOneBySomeField($value): ?PsychiatricEvaluation
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
