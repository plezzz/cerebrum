<?php


namespace App\Service\Patient;


use App\Entity\Patient\Patient;
use App\Repository\PatientRepository;


/**
 * @method getDoctrine()
 */
class PatientService implements PatientServiceInterface
{

//    private Security $security;
    private PatientRepository $patientRepository;
//    private DateTimeServiceInterface $dateTimeService;
//    private UserPasswordEncoderInterface $passwordEncoder;
//    // private RoleServiceInterface $roleService;

    public function __construct(
//        Security $security,
        PatientRepository $patientRepository,
//                                DateTimeServiceInterface $dateTimeService,
//                                UserPasswordEncoderInterface $passwordEncoder,
        // RoleServiceInterface $roleService
    )
    {
        //  $this->roleService = $roleService;
//        $this->passwordEncoder = $passwordEncoder;
//        $this->security = $security;
        $this->patientRepository = $patientRepository;
//        $this->dateTimeService = $dateTimeService;
    }


    public function save(Patient $patient): string
    {
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
}
