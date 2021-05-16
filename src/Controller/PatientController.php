<?php

namespace App\Controller;

use AndreaSprega\Bundle\BreadcrumbBundle\Annotation\Breadcrumb;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Form\IDCardType;
use App\Form\PatientType;
use App\Service\Patient\PatientServiceInterface;
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


            //return $this->redirectToRoute('patient/id-card-create');
        }

        return $this->render('patient/id-card-create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
