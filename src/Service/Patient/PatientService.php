<?php


namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Repository\Patient\ContactsRepository;
use App\Repository\Patient\DetailsRepository;
use App\Repository\Patient\IDCardRepository;
use App\Repository\PatientRepository;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\User\UserServiceInterface;


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

//    // private RoleServiceInterface $roleService;

    public function __construct(
        UserServiceInterface $userService,
        PatientRepository $patientRepository,
        DateTimeServiceInterface $dateTimeService,
        IDCardRepository $IDCardRepository,
        DetailsRepository $detailsRepository,
        ContactsRepository $contactsRepository
    )
    {
        $this->userService = $userService;
        $this->patientRepository = $patientRepository;
        $this->dateTimeService = $dateTimeService;
        $this->IDCardRepository = $IDCardRepository;
        $this->detailsRepository = $detailsRepository;
        $this->contactRepository = $contactsRepository;
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

    public function saveIDCard(IDCard $IDCard, Patient $patient)
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
        if ($details->getSex() === 'Жена'){
            $profilePicture = 'female.png';
        }else{
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

    public function saveContacts(Contacts $contacts, Patient $patient)
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $contacts->setCreatedBy($user);
        $contacts->setEditedBy($user);
        $contacts->setCreatedAt($date);
        $contacts->setEditedAt($date);
        $contacts->setPatient($patient);

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

    public function findByEGN($EGN)
    {
        return $this->patientRepository->getByKeyword($EGN);
    }
}
