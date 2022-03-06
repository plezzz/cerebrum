<?php


namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Entity\Patient\PsychiatricEvaluation;
use App\Entity\Patient\Report;
use App\Entity\Patient\SocialEvaluation;
use App\Repository\Patient\ContactsRepository;
use App\Repository\Patient\DetailsRepository;
use App\Repository\Patient\IDCardRepository;
use App\Repository\Patient\PsychiatricEvaluationRepository;
use App\Repository\Patient\ReportRepository;
use App\Repository\Patient\SocialEvaluationRepository;
use App\Repository\PatientRepository;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\User\UserServiceInterface;
use Doctrine\ORM\ORMException;


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
    private SocialEvaluationRepository $socialEvaluationRepository;

//    // private RoleServiceInterface $roleService;

    public function __construct(
        UserServiceInterface $userService,
        PatientRepository $patientRepository,
        DateTimeServiceInterface $dateTimeService,
        IDCardRepository $IDCardRepository,
        DetailsRepository $detailsRepository,
        ContactsRepository $contactsRepository,
        ReportRepository $reportRepository,
        PsychiatricEvaluationRepository $psychiatricEvaluationRepository,
        SocialEvaluationRepository $socialEvaluationRepository
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
        $this->socialEvaluationRepository = $socialEvaluationRepository;
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
        if (!$isEdit){
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
     * @return bool
     * @throws ORMException
     */
    public function addPsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation, Patient $patient): bool
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $psychiatricEvaluation->setCreatedBy($user);
        $psychiatricEvaluation->setCreatedAt($date);
        $psychiatricEvaluation->setEditedBy($user);
        $psychiatricEvaluation->setEditedAt($date);
        $psychiatricEvaluation->addPatient($patient);
        return $this->psychiatricEvaluationRepository->insert($psychiatricEvaluation);
    }

    /**
     * @param SocialEvaluation $socialEvaluation
     * @param Patient $patient
     * @return void
     * @throws ORMException
     */
    public function addSocialEvaluation(SocialEvaluation $socialEvaluation , Patient $patient): void
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $socialEvaluation->setCreatedBy($user);
        $socialEvaluation->setCreatedAt($date);
        $socialEvaluation->setEditedBy($user);
        $socialEvaluation->setEditedAt($date);
        $socialEvaluation->addPatient($patient);
        $this->socialEvaluationRepository->add($socialEvaluation);
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
}
