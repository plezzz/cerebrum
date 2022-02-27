<?php

namespace App\Repository\Patient;

use App\Entity\Patient\Report;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\OptimisticLockException;
use Doctrine\ORM\ORMException;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @method Report|null find($id, $lockMode = null, $lockVersion = null)
 * @method Report|null findOneBy(array $criteria, array $orderBy = null)
 * @method Report[]    findAll()
 * @method Report[]    findBy(array $criteria, array $orderBy = null, $limit = null, $offset = null)
 */
class ReportRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Report::class);
    }


    /**
     * @param Report $report
     * @return bool
     * @throws ORMException
     */
    public function insert(Report $report): bool
    {
        try {
            $this->_em->persist($report);
            $this->_em->flush();
            return true;
        } catch (OptimisticLockException $e) {
            return false;
        }
    }


    public function timeline(int $patientID): array
    {
        $conn = $this->getEntityManager()->getConnection();

        $sql = '
SELECT id, description, created_at, "Добавен е нов рапорт" AS line_description, "clinical_fe.png" AS icon
	FROM report 
	LEFT JOIN report_patient ON report_patient.report_id = report.id
	WHERE report_patient.patient_id = :patientID
UNION
    SELECT id, diagnostic, created_at, "Добавена е психиатрична оценка", "i_note_action.png"
    FROM
        psychiatric_evaluation
	LEFT JOIN psychiatric_evaluation_patient ON psychiatric_evaluation_patient.psychiatric_evaluation_id = psychiatric_evaluation.id
	WHERE psychiatric_evaluation_patient.patient_id = :patientID
UNION	
	  SELECT 
		  id, original_name, created_at, "Добавен е нов файл", "i_documents_accepted.png"
    FROM file_upload
    WHERE	patient_id = :patientID
UNION	
	  SELECT 
		  id, first_name, created_at, "Добавен е нов контакт", "medical_advice.png"
    FROM contacts
    WHERE	patient_id = :patientID
ORDER BY created_at DESC LIMIT 50
            ';
        $stmt = $conn->prepare($sql);

//        $stmt->execute(['patientID' => $patientID]);
//
// // TODO vremeva linia - executeQuery() + fetchAllAssociative()
        $result = $stmt->executeQuery(['patientID' => $patientID]);

        // returns an array of arrays (i.e. a raw data set)
        return $result->fetchAllAssociative();
    }


// /**
//  * @return Report[] Returns an array of Report objects
//  */
    /*
    public function findByExampleField($value)
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->orderBy('r.id', 'ASC')
            ->setMaxResults(10)
            ->getQuery()
            ->getResult()
        ;
    }
    */

    /*
    public function findOneBySomeField($value): ?Report
    {
        return $this->createQueryBuilder('r')
            ->andWhere('r.exampleField = :val')
            ->setParameter('val', $value)
            ->getQuery()
            ->getOneOrNullResult()
        ;
    }
    */
}
