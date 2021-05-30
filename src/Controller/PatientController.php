<?php

namespace App\Controller;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Form\IDCardType;
use App\Form\PatientContactType;
use App\Form\PatientDetailsType;
use App\Form\PatientType;
use App\Service\Patient\PatientServiceInterface;
use SlopeIt\BreadcrumbBundle\Annotation\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class PatientController extends AbstractController
{
    private PatientServiceInterface $patientService;

    public function __construct(PatientServiceInterface $patientService)
    {
        $this->patientService = $patientService;
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Всички пациенти", "route" = "all-patients"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patients', name: 'all-patients')]
    public function allPatients(Request $request): Response
    {
        $allPatients = $this->patientService->findAll();

        return $this->render('patient/all-patients.html.twig', [
            'patients' => $allPatients
        ]);
    }




    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Създаване на пациент", "route" = "patient-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient-create', name: 'patient-create')]
    public function patientCreate(Request $request): Response
    {
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {

            $patient = $form->getData();
            $egn = $patient->getEGN();
            $this->patientService->save($patient);

            return $this->redirectToRoute('patient-id-card-create',['egn'=>$egn]);
        }

        return $this->render('patient/patient-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Пациент", "route" = "patient-create"},{"label" = "Регистрация на лична карта", "route" = "patient-id-card-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/id-card-create', name: 'patient-id-card-create')]
    public function idCardCreate(Request $request): Response
    {

        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $idCard = new IDCard();
        //$idCard->setPatient($patient);
        $form = $this->createForm(IDCardType::class, $idCard);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $idCard = $form->getData();
            $this->patientService->saveIDCard($idCard, $patient);


            return $this->redirectToRoute('patient-personal-info-create', ['egn'=>$egn]);
        }

        return $this->render('patient/id-card-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Пациент", "route" = "patient-create"},{"label" = "Лична информация", "route" = "patient-personal-info-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/personal-info-create', name: 'patient-personal-info-create')]
    public function personalInfoCreate(Request $request): Response
    {

        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $personalInfo = new Details();
        //$idCard->setPatient($patient);
        $form = $this->createForm(PatientDetailsType::class, $personalInfo);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $personalInfo = $form->getData();
            $this->patientService->savePersonalDetails($personalInfo, $patient);


            return $this->redirectToRoute('patient-contacts-create', ['egn'=>$egn]);
        }

        return $this->render('patient/personal-info-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Пациент", "route" = "patient-create"},{"label" = "Контакти на пацеинта", "route" = "patient-contacts-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/contact-create', name: 'patient-contacts-create')]
    public function patientContactsCreate(Request $request): Response
    {

        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $contacts = new Contacts();
        //$idCard->setPatient($patient);
        $form = $this->createForm(PatientContactType::class, $contacts);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $contacts = $form->getData();
            $this->patientService->saveContacts($contacts, $patient);


            return $this->redirectToRoute('patient-contacts-create', ['egn'=>$egn]);
        }

        return $this->render('patient/patient-contacts-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb({"label" = "home", "route" = "home"},{"label" = "Всички пациенти", "route" = "all-patients"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/{id}', name: 'patient')]
    public function PatientID(Request $request,$id): Response
    {
        $patient = $this->patientService->findOneByID($id);

        return $this->render('patient/patient-view.html.twig', [
            'patient' => $patient
        ]);
    }
}
