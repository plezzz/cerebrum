<?php

namespace App\Repository;

use App\Entity\Patient\Patient;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\AbstractQuery;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Patient|null find($id, $lockMode = null, $lockVersion = null)
 * @method Patient|null findOneBy(array $criteria, array $orderBy = null)
 * @method Patient[]    findAll()
 * @method Patient[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class PatientRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Patient::class);
    }

    /**
     * @param Patient $patient
     * @return bool
     * @throws ORMException
     */
    public function insert(Patient $patient): bool
    {
        try {
            $this->_em->persist($patient);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }

    /**
     * @param Patient $patient
     * @return bool
     * @throws ORMException
     */
    public function update(Patient $patient)
    {
        try {
            $this->_em->persist($patient);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }

    public function findEntitiesByString($str)
    {
        return $this->getEntityManager()
            ->createQuery(
                'SELECT e
                FROM App:Patient e
                WHERE e.EGN LIKE :str'
            )
            ->setParameter('str', '%' . $str . '%')
            ->getResult();
    }

    public function getByKeyword($keyword): array
    {
        return $this->createQueryBuilder('m')
            ->where("m.EGN LIKE '%$keyword%'")
            ->getQuery()
            ->getResult(AbstractQuery::HYDRATE_OBJECT);
    }

    // /**
    //  * @return Patient[] Returns an array of Patient objects
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
    public function findOneBySomeField($value): ?Patient
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
