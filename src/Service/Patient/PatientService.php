<?php


namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Entity\Patient\PsychiatricEvaluation;
use App\Entity\Patient\PsychiatricEvaluationNote;
use App\Entity\Patient\PsychologicalEvaluation;
use App\Entity\Patient\PsychologicalEvaluationNote;
use App\Entity\Patient\Report;
use App\Entity\Patient\SocialEvaluation;
use App\Entity\Patient\SocialEvaluationNote;
use App\Repository\Patient\ContactsRepository;
use App\Repository\Patient\DetailsRepository;
use App\Repository\Patient\IDCardRepository;
use App\Repository\Patient\PsychiatricEvaluationNoteRepository;
use App\Repository\Patient\PsychiatricEvaluationRepository;
use App\Repository\Patient\PsychologicalEvaluationRepository;
use App\Repository\Patient\PsychologicalEvaluationNoteRepository;
use App\Repository\Patient\ReportRepository;
use App\Repository\Patient\SocialEvaluationNoteRepository;
use App\Repository\Patient\SocialEvaluationRepository;
use App\Repository\PatientRepository;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\User\UserServiceInterface;
use Doctrine\ORM\Exception\ORMException;
use Doctrine\ORM\OptimisticLockException;


/**
 * @method getDoctrine()
 */
class PatientService implements PatientServiceInterface
{


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
    }


    public function save(Patient $patient): string
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();

        $patient->setCreatedBy($user);
        $patient->setEditedBy($user);
        $patient->setCreatedAt($date);
        $patient->setEditedAt($date);
        $patient->setProfilePicture('uni.png');
        $patient->setPatientID($this->generateID($patient));
        $egn = $patient->getEGN();
        $this->patientRepository->insert($patient);
        return $egn;
    }

    /**
     * @throws ORMException
     */
    public function edit(Patient $patient): bool
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $patient->setEditedBy($user);
        $patient->setEditedAt($date);
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

    public function saveIDCard(IDCard $IDCard, Patient $patient): ?int
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $IDCard->setCreatedBy($user);
        $IDCard->setEditedBy($user);
        $IDCard->setCreatedAt($date);
        $IDCard->setEditedAt($date);

        $this->IDCardRepository->insert($IDCard);
        $patient->setIDCard($IDCard);
        $patient->setEditedBy($user);
        $patient->setEditedAt($date);
        $this->patientRepository->insert($patient);
        return $IDCard->getId();
    }

    public function savePersonalDetails(Details $details, Patient $patient)
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        if ($details->getSex() === 'Жена') {
            $profilePicture = 'female.png';
        } else {
            $profilePicture = 'male.png';
        }

        $details->setCreatedBy($user);
        $details->setEditedBy($user);
        $details->setCreatedAt($date);
        $details->setEditedAt($date);

        $this->detailsRepository->insert($details);
        $patient->setDetails($details);
        $patient->setEditedBy($user);
        $patient->setEditedAt($date);
        $patient->setProfilePicture($profilePicture);
        $this->patientRepository->insert($patient);
        return $details->getId();
    }

    public function saveContacts(Contacts $contacts, Patient $patient, $isEdit)
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        if (!$isEdit) {
            $contacts->setCreatedBy($user);
            $contacts->setCreatedAt($date);
        }
        $contacts->setEditedBy($user);
        $contacts->setEditedAt($date);
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
        $patient->setEditedBy($user);
        $patient->setEditedAt($date);
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
     * @throws ORMException
     */
    public function addReport(Report $report, Patient $patient): bool
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $report->setCreatedBy($user);
        $report->setCreatedAt($date);
        $report->addPatient($patient);
        return $this->reportRepository->insert($report);

    }

    /**
     * @param PsychiatricEvaluation $psychiatricEvaluation
     * @param Patient $patient
     * @param bool $isEdit
     * @return bool
     * @throws ORMException
     */
    public function PsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation, Patient $patient, bool $isEdit): bool
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        if (!$isEdit) {
            $psychiatricEvaluation->setCreatedBy($user);
            $psychiatricEvaluation->setCreatedAt($date);
        }
        $psychiatricEvaluation->setEditedBy($user);
        $psychiatricEvaluation->setEditedAt($date);
        $psychiatricEvaluation->setPatient($patient);
        return $this->psychiatricEvaluationRepository->insert($psychiatricEvaluation);
    }

    /**
     * @param PsychiatricEvaluationNote $psychiatricEvaluationNote
     * @param Patient $patient
     * @param bool $isEdit
     * @return void
     * @throws ORMException
     * @throws OptimisticLockException
     */
    public function PsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote, Patient $patient, bool $isEdit): void
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $immutableDate = $this->dateTimeService->dateTimeToImmutableDateTime($date);
        if (!$isEdit) {
            $psychiatricEvaluationNote->setCreatedBy($user);
            $psychiatricEvaluationNote->setCreatedAt($immutableDate);
        }
        $psychiatricEvaluationNote->setEditedBy($user);
        $psychiatricEvaluationNote->setEditedAt($immutableDate);
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
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $immutableDate = $this->dateTimeService->dateTimeToImmutableDateTime($date);
        if (!$isEdit) {
            $socialEvaluation->setCreatedBy($user);
            $socialEvaluation->setCreatedAt($immutableDate);
        }
        $socialEvaluation->setEditedBy($user);
        $socialEvaluation->setEditedAt($immutableDate);
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
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $immutableDate = $this->dateTimeService->dateTimeToImmutableDateTime($date);
        if (!$isEdit) {
            $socialEvaluationNote->setCreatedBy($user);
            $socialEvaluationNote->setCreatedAt($immutableDate);
        }
        $socialEvaluationNote->setEditedBy($user);
        $socialEvaluationNote->setEditedAt($immutableDate);
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
        $second = mb_substr($patient->getLastName(), 0, 1, "utf-8");
        $third = mb_substr($patient->getMiddleName(), 0, 1, "utf-8");
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
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $immutableDate = $this->dateTimeService->dateTimeToImmutableDateTime($date);
        if (!$isEdit) {
            $psychologicalEvaluation->setCreatedBy($user);
            $psychologicalEvaluation->setCreatedAt($immutableDate);
        }
        $psychologicalEvaluation->setEditedBy($user);
        $psychologicalEvaluation->setEditedAt($immutableDate);
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
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $immutableDate = $this->dateTimeService->dateTimeToImmutableDateTime($date);
        if (!$isEdit) {
            $psychologicalEvaluationNote->setCreatedBy($user);
            $psychologicalEvaluationNote->setCreatedAt($immutableDate);
        }
        $psychologicalEvaluationNote->setEditedBy($user);
        $psychologicalEvaluationNote->setEditedAt($immutableDate);
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
     */
    public function deletePsychologicalNote(int $id): void
    {
        $evaluationNote = $this->psychologicalEvaluationNoteRepository->find($id);
        $this->psychologicalEvaluationNoteRepository->remove($evaluationNote);
    }

}
