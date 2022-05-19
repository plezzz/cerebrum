<?php


namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\Family;
use App\Entity\Patient\Habits;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Entity\Patient\PsychiatricEvaluation;
use App\Entity\Patient\PsychiatricEvaluationNote;
use App\Entity\Patient\PsychologicalEvaluation;
use App\Entity\Patient\PsychologicalEvaluationNote;
use App\Entity\Patient\Report;
use App\Entity\Patient\SocialEvaluation;
use App\Entity\Patient\SocialEvaluationNote;
use App\Entity\Patient\TemperatureList;
use App\Entity\User;
use App\Repository\Patient\ContactsRepository;
use App\Repository\Patient\DetailsRepository;
use App\Repository\Patient\FamilyRepository;
use App\Repository\Patient\HabitsRepository;
use App\Repository\Patient\IDCardRepository;
use App\Repository\Patient\PsychiatricEvaluationNoteRepository;
use App\Repository\Patient\PsychiatricEvaluationRepository;
use App\Repository\Patient\PsychologicalEvaluationRepository;
use App\Repository\Patient\PsychologicalEvaluationNoteRepository;
use App\Repository\Patient\ReportRepository;
use App\Repository\Patient\SocialEvaluationNoteRepository;
use App\Repository\Patient\SocialEvaluationRepository;
use App\Repository\Patient\TemperatureListRepository;
use App\Repository\Patient\TherapyRepository;
use App\Repository\PatientRepository;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\User\UserServiceInterface;
use DateTimeImmutable;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;

/**
 * @method getDoctrine()
 */
class PatientService implements PatientServiceInterface
{

    private ?User $user;
    private DateTimeImmutable $date;

    private PatientRepository $patientRepository;
    private DateTimeServiceInterface $dateTimeService;
    private UserServiceInterface $userService;
    private IDCardRepository $IDCardRepository;
    private DetailsRepository $detailsRepository;
    private ContactsRepository $contactRepository;
    private ReportRepository $reportRepository;
    private PsychiatricEvaluationRepository $psychiatricEvaluationRepository;
    private PsychiatricEvaluationNoteRepository $psychiatricEvaluationNoteRepository;
    private SocialEvaluationRepository $socialEvaluationRepository;
    private SocialEvaluationNoteRepository $socialEvaluationNoteRepository;
    private PsychologicalEvaluationRepository $psychologicalEvaluationRepository;
    private PsychologicalEvaluationNoteRepository $psychologicalEvaluationNoteRepository;
    private HabitsRepository $habitsRepository;
    private FamilyRepository $familyRepository;
    private TemperatureListRepository $temperatureListRepository;
    private TherapyRepository $therapyRepository;

    public function __construct(
        UserServiceInterface                  $userService,
        PatientRepository                     $patientRepository,
        DateTimeServiceInterface              $dateTimeService,
        IDCardRepository                      $IDCardRepository,
        DetailsRepository                     $detailsRepository,
        ContactsRepository                    $contactsRepository,
        ReportRepository                      $reportRepository,
        PsychiatricEvaluationRepository       $psychiatricEvaluationRepository,
        PsychiatricEvaluationNoteRepository   $psychiatricEvaluationNoteRepository,
        SocialEvaluationRepository            $socialEvaluationRepository,
        SocialEvaluationNoteRepository        $socialEvaluationNoteRepository,
        PsychologicalEvaluationRepository     $psychologicalEvaluationRepository,
        PsychologicalEvaluationNoteRepository $psychologicalEvaluationNoteRepository,
        HabitsRepository                      $habitsRepository,
        FamilyRepository                      $familyRepository,
        TemperatureListRepository             $temperatureListRepository,
        TherapyRepository                     $therapyRepository,
    )
    {
        $this->userService = $userService;
        $this->patientRepository = $patientRepository;
        $this->dateTimeService = $dateTimeService;
        $this->IDCardRepository = $IDCardRepository;
        $this->detailsRepository = $detailsRepository;
        $this->contactRepository = $contactsRepository;
        $this->reportRepository = $reportRepository;
        $this->psychiatricEvaluationRepository = $psychiatricEvaluationRepository;
        $this->psychiatricEvaluationNoteRepository = $psychiatricEvaluationNoteRepository;
        $this->socialEvaluationRepository = $socialEvaluationRepository;
        $this->socialEvaluationNoteRepository = $socialEvaluationNoteRepository;
        $this->psychologicalEvaluationRepository = $psychologicalEvaluationRepository;
        $this->psychologicalEvaluationNoteRepository = $psychologicalEvaluationNoteRepository;
        $this->habitsRepository = $habitsRepository;
        $this->user = $this->userService->currentUser();
        $this->date = $this->dateTimeService->immutableDateTime();
        $this->familyRepository = $familyRepository;
        $this->temperatureListRepository = $temperatureListRepository;
        $this->therapyRepository = $therapyRepository;
    }


    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function save(Patient $patient): string
    {
        $patient->setCreatedBy($this->user);
        $patient->setEditedBy($this->user);
        $patient->setCreatedAt($this->date);
        $patient->setEditedAt($this->date);
        $patient->setProfilePicture('uni.png');
        $patient->setPatientID($this->generateID($patient));
        $egn = $patient->getEGN();
        $this->patientRepository->insert($patient);
        return $egn;
    }

    /**
     * @param Patient $patient
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function edit(Patient $patient): bool
    {
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        return $this->patientRepository->insert($patient);

    }

    public function findAll(): array
    {
        return $this->patientRepository->findAll();
    }

    public function findOneByEGN($egn): ?Patient
    {
        return $this->patientRepository->findOneBy(['EGN' => $egn]);
    }

    public function findOneByID($id): ?Patient
    {
        return $this->patientRepository->find($id);
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveIDCard(IDCard $IDCard, Patient $patient): ?int
    {
        $IDCard->setCreatedBy($this->user);
        $IDCard->setEditedBy($this->user);
        $IDCard->setCreatedAt($this->date);
        $IDCard->setEditedAt($this->date);

        $this->IDCardRepository->insert($IDCard);
        $patient->setIDCard($IDCard);
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        $this->patientRepository->insert($patient);
        return $IDCard->getId();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function savePersonalDetails(Details $details, Patient $patient): ?int
    {
        if ($details->getSex() === 'Жена') {
            $profilePicture = 'female.png';
        } elseif ($details->getSex() === 'Мъж') {
            $profilePicture = 'male.png';
        } else {
            $profilePicture = 'uni.png';
        }

        $details->setCreatedBy($this->user);
        $details->setEditedBy($this->user);
        $details->setCreatedAt($this->date);
        $details->setEditedAt($this->date);

        $this->detailsRepository->insert($details);
        $patient->setDetails($details);
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        $patient->setProfilePicture($profilePicture);
        $this->patientRepository->insert($patient);
        return $details->getId();
    }

    /**
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveContacts(Contacts $contacts, Patient $patient, $isEdit): ?int
    {
        if (!$isEdit) {
            $contacts->setCreatedBy($this->user);
            $contacts->setCreatedAt($this->date);
        }
        $contacts->setEditedBy($this->user);
        $contacts->setEditedAt($this->date);
        $contacts->setPatient($patient);

        //TODO: Прави промяна за всички пациенти не само за конкретния пацент.
        if ($contacts->getIsDefaultContact() === true) {
            $currentActive = $this->contactRepository->findOneBy(['isDefaultContact' => true]);
            if ($currentActive !== null) {
                $currentActive->setIsDefaultContact(false);
                $this->contactRepository->insert($currentActive);
            }
        }

        $this->contactRepository->insert($contacts);
        $patient->addContact($contacts);
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        $this->patientRepository->insert($patient);
        return $contacts->getId();
    }

    /**
     * @param $EGN
     * @return array
     */
    public function findByEGN($EGN): array
    {
        return $this->patientRepository->getByKeyword($EGN);
    }

    /**
     * @param Report $report
     * @param Patient $patient
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function addReport(Report $report, Patient $patient): bool
    {
        $report->setCreatedBy($this->user);
        $report->setCreatedAt($this->date);
        $report->addPatient($patient);
        return $this->reportRepository->insert($report);

    }

    /**
     * @param PsychiatricEvaluation $psychiatricEvaluation
     * @param Patient $patient
     * @param bool $isEdit
     * @return bool
     * @throws \Doctrine\ORM\ORMException
     */
    public function PsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation, Patient $patient, bool $isEdit): bool
    {
        if (!$isEdit) {
            $psychiatricEvaluation->setCreatedBy($this->user);
            $psychiatricEvaluation->setCreatedAt($this->date);
        }
        $psychiatricEvaluation->setEditedBy($this->user);
        $psychiatricEvaluation->setEditedAt($this->date);
        $psychiatricEvaluation->setPatient($patient);
        return $this->psychiatricEvaluationRepository->insert($psychiatricEvaluation);
    }

    /**
     * @param PsychiatricEvaluationNote $psychiatricEvaluationNote
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function PsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote, Patient $patient, bool $isEdit): void
    {
        if (!$isEdit) {
            $psychiatricEvaluationNote->setCreatedBy($this->user);
            $psychiatricEvaluationNote->setCreatedAt($this->date);
        }
        $psychiatricEvaluationNote->setEditedBy($this->user);
        $psychiatricEvaluationNote->setEditedAt($this->date);
        $psychiatricEvaluationNote->setPatient($patient);
        $this->psychiatricEvaluationNoteRepository->add($psychiatricEvaluationNote);
    }


    public function getTimeline($id): array
    {
        return $this->reportRepository->timeline($id);
    }

    /**
     * @param $id
     * @return Contacts|null
     */
    public function findOneContactByID($id): ?Contacts
    {
        return $this->contactRepository->find($id);
    }

    /**
     * @param int $id
     * @return bool
     */
    public function deleteContact(int $id): bool
    {
        $contact = $this->contactRepository->find($id);
        return $this->contactRepository->delete($contact);
    }

    /**
     * @param $id
     * @return array
     */
    public function getPsychiatricNotes($id): array
    {
        return $this->psychiatricEvaluationNoteRepository->findBy(['patient' => $id], ['createdAt' => 'ASC']);
    }

    /**
     * @param $id
     * @return PsychiatricEvaluationNote|null
     */
    public function getPsychiatricNote($id): ?PsychiatricEvaluationNote
    {
        return $this->psychiatricEvaluationNoteRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param int $id
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function deletePsychiatricNote(int $id): void
    {
        $evaluationNote = $this->psychiatricEvaluationNoteRepository->find($id);
        $this->psychiatricEvaluationNoteRepository->remove($evaluationNote);
    }

    /**
     * @param SocialEvaluation $socialEvaluation
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws ORMException|\Doctrine\ORM\ORMException
     */
    public function SocialEvaluation(SocialEvaluation $socialEvaluation, Patient $patient, bool $isEdit): void
    {
        if (!$isEdit) {
            $socialEvaluation->setCreatedBy($this->user);
            $socialEvaluation->setCreatedAt($this->date);
        }
        $socialEvaluation->setEditedBy($this->user);
        $socialEvaluation->setEditedAt($this->date);
        $socialEvaluation->setPatient($patient);
        $this->socialEvaluationRepository->add($socialEvaluation);
    }

    /**
     * @param SocialEvaluationNote $socialEvaluationNote
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function SocialEvaluationNote(SocialEvaluationNote $socialEvaluationNote, Patient $patient, bool $isEdit): void
    {
        if (!$isEdit) {
            $socialEvaluationNote->setCreatedBy($this->user);
            $socialEvaluationNote->setCreatedAt($this->date);
        }
        $socialEvaluationNote->setEditedBy($this->user);
        $socialEvaluationNote->setEditedAt($this->date);
        $socialEvaluationNote->setPatient($patient);
        $this->socialEvaluationNoteRepository->add($socialEvaluationNote);
    }

    /**
     * @param $id
     * @return array
     */
    public function getSocialNotes($id): array
    {
        return $this->socialEvaluationNoteRepository->findBy(['patient' => $id], ['createdAt' => 'ASC']);
    }

    /**
     * @param $id
     * @return SocialEvaluationNote|null
     */
    public function getSocialNote($id): ?SocialEvaluationNote
    {
        return $this->socialEvaluationNoteRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param int $id
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function deleteSocialNote(int $id): void
    {
        $evaluationNote = $this->socialEvaluationNoteRepository->find($id);
        $this->socialEvaluationNoteRepository->remove($evaluationNote);
    }

    /**
     * Generate patient ID from full name and first 4 digits form EGN
     * @param $patient
     * @return string
     */
    function generateID($patient): string
    {
        $first = mb_substr($patient->getFirstName(), 0, 1, "utf-8");
        $second = mb_substr($patient->getMiddleName(), 0, 1, "utf-8");
        $third = mb_substr($patient->getLastName(), 0, 1, "utf-8");
        $fourth = mb_substr($patient->getEGN(), 0, 4, "utf-8");
        return $first . $second . $third . $fourth;
    }

    /**
     * @param PsychologicalEvaluation $psychologicalEvaluation
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function PsychologicalEvaluation(PsychologicalEvaluation $psychologicalEvaluation, Patient $patient, bool $isEdit): void
    {
        if (!$isEdit) {
            $psychologicalEvaluation->setCreatedBy($this->user);
            $psychologicalEvaluation->setCreatedAt($this->date);
        }
        $psychologicalEvaluation->setEditedBy($this->user);
        $psychologicalEvaluation->setEditedAt($this->date);
        $psychologicalEvaluation->setPatient($patient);
        $this->psychologicalEvaluationRepository->add($psychologicalEvaluation);
    }

    /**
     * @param PsychologicalEvaluationNote $psychologicalEvaluationNote
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function PsychologicalEvaluationNote(PsychologicalEvaluationNote $psychologicalEvaluationNote, Patient $patient, bool $isEdit): void
    {
        if (!$isEdit) {
            $psychologicalEvaluationNote->setCreatedBy($this->user);
            $psychologicalEvaluationNote->setCreatedAt($this->date);
        }
        $psychologicalEvaluationNote->setEditedBy($this->user);
        $psychologicalEvaluationNote->setEditedAt($this->date);
        $psychologicalEvaluationNote->setPatient($patient);
        $this->psychologicalEvaluationNoteRepository->add($psychologicalEvaluationNote);
    }

    /**
     * @param $id
     * @return array
     */
    public function getPsychologicalNotes($id): array
    {
        return $this->psychologicalEvaluationNoteRepository->findBy(['patient' => $id], ['createdAt' => 'ASC']);
    }

    /**
     * @param $id
     * @return PsychologicalEvaluationNote|null
     */
    public function getPsychologicalNote($id): ?PsychologicalEvaluationNote
    {
        return $this->psychologicalEvaluationNoteRepository->findOneBy(['id' => $id]);
    }

    /**
     * @param int $id
     * @return void
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function deletePsychologicalNote(int $id): void
    {
        $evaluationNote = $this->psychologicalEvaluationNoteRepository->find($id);
        $this->psychologicalEvaluationNoteRepository->remove($evaluationNote);
    }

    /**
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveHabits(Habits $habits, Patient $patient, $isEdit): ?int
    {
        if (!$isEdit) {
            $habits->setCreatedBy($this->user);
            $habits->setCreatedAt($this->date);
        }

        $habits->setEditedBy($this->user);
        $habits->setEditedAt($this->date);
        $habits->setPatient($patient);

        $this->habitsRepository->add($habits);
        $patient->setHabits($habits);
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        $this->patientRepository->insert($patient);
        return $habits->getId();
    }

    /**
     * @throws OptimisticLockException
     * @throws \Doctrine\ORM\ORMException
     */
    public function saveFamily(Family $family, Patient $patient, $isEdit): ?int
    {
        if (!$isEdit) {
            $family->setCreatedBy($this->user);
            $family->setCreatedAt($this->date);
        }

        $family->setEditedBy($this->user);
        $family->setEditedAt($this->date);
        $family->setPatient($patient);

        $this->familyRepository->add($family);
        $patient->setFamily($family);
        $patient->setEditedBy($this->user);
        $patient->setEditedAt($this->date);
        $this->patientRepository->insert($patient);
        return $family->getId();
    }

    /**
     *
     */
    public function addTemperatureList(TemperatureList $temperatureList, Patient $patient): void
    {
        //$therapies = $temperatureList->getTherapies();
   //     $file = 'file.txt';

        //file_put_contents($file, print_r($therapies, true));
//        foreach ($therapies as $therapy) {
//            $this->therapyRepository->add($therapy);
//            file_put_contents($file, print_r($therapy, true));
//        }

       // if (!$isEdit) {
            $temperatureList->setCreatedBy($this->user);
            $temperatureList->setCreatedAt($this->date);
       // }

        $temperatureList->setEditedBy($this->user);
        $temperatureList->setEditedAt($this->date);
        $temperatureList->setPatient($patient);

        $this->temperatureListRepository->add($temperatureList);
        //$patient->addTemperatureList($temperatureList);
//        $patient->setEditedBy($this->user);
//        $patient->setEditedAt($this->date);
//        $this->patientRepository->insert($patient);
//        foreach ($originalTags as $tag) {
//            if (false === $task->getTags()->contains($tag)) {
//                // remove the Task from the Tag
//                $tag->getTasks()->removeElement($task);
//
//                // if it was a many-to-one relationship, remove the relationship like this
//                // $tag->setTask(null);
//
//                $entityManager->persist($tag);
//
//                // if you wanted to delete the Tag entirely, you can also do that
//                // $entityManager->remove($tag);
//            }
//        }
//
//        $entityManager->persist($task);
//        $entityManager->flush();
//
//        // redirect back to some edit page
//        return $this->redirectToRoute('task_edit', ['id' => $id]);
    }

    /**
     * @param $id
     * @return array
     */
    public function getTemperatureList($id): array
    {
        return $this->temperatureListRepository->findBy(['patient' => $id]);
    }
}
