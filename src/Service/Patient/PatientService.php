<?php


namespace App\Service\Patient;


use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
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

//    // private RoleServiceInterface $roleService;

    public function __construct(
        UserServiceInterface $userService,
        PatientRepository $patientRepository,
        DateTimeServiceInterface $dateTimeService,
        IDCardRepository $IDCardRepository,
    )
    {
        $this->userService = $userService;
        $this->patientRepository = $patientRepository;
        $this->dateTimeService = $dateTimeService;
        $this->IDCardRepository = $IDCardRepository;
    }


    public function save(Patient $patient): string
    {
        $user = $this->userService->currentUser();
        $date = $this->dateTimeService->setDateTimeNow();
        $patient->setCreatedBy($user);
        $patient->setEditedBy($user);
        $patient->setCreatedAt($date);
        $patient->setEditedAt($date);
        $egn = $patient->getEGN();
        $this->patientRepository->insert($patient);
        return $egn;
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

    public function saveIDCard(IDCard $IDCard,Patient $patient)
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
}
