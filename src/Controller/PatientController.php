<?php

namespace App\Controller;


use App\Entity\Patient\Allergy;
use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\Habits;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Entity\Patient\School;
use App\Entity\Patient\Schools;
use App\Entity\Patient\TemperatureList;
use App\Entity\Patient\Therapy;
use App\Entity\Patient\Workplace;
use App\Entity\Patient\Workplaces;
use App\Form\AllergyType;
use App\Form\FamilyType;
use App\Form\HabitsType;
use App\Form\IDCardType;
use App\Form\PatientContactType;
use App\Form\PatientDetailsType;
use App\Form\PatientPsychiatricEvaluationNoteType;
use App\Form\PatientPsychiatricEvaluationType;
use App\Form\PatientPsychologicalEvaluationNoteType;
use App\Form\PatientPsychologicalEvaluationType;
use App\Form\PatientReportType;
use App\Form\PatientSocialEvaluationNoteType;
use App\Form\PatientSocialEvaluationType;
use App\Form\PatientType;
use App\Form\ProfilePictureUploadType;
use App\Form\SchoolsType;
use App\Form\SchoolType;
use App\Form\TemperatureListType;
use App\Form\WorkplacesType;
use App\Form\WorkplaceType;
use App\Service\Patient\PatientServiceInterface;
use App\Service\Patient\ProfilePictureUploadService;
use Doctrine\Common\Collections\ArrayCollection;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
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
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Всички пациенти", "route" = "all-patients"})
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
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Създаване на пациент", "route" = "patient-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient-create', name: 'patient-create')]
    public function patientCreate(Request $request): Response
    {
        $isEdit = false;
        $patient = new Patient();
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();
            $egn = $patient->getEGN();
            $this->patientService->save($patient, $isEdit);

            return $this->redirectToRoute('patient-id-card-create', ['egn' => $egn]);
        }

        return $this->render('patient/patient-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Създаване на пациент", "route" = "patient-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient-edit/{id}', name: 'patient-edit')]
    public function patientEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(PatientType::class, $patient);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $patient = $form->getData();
            $this->patientService->save($patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'about']);
        }

        return $this->render('patient/patient-create.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Регистрация на лична карта", "route" = "patient-id-card-create"}
     *     )
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/id-card-create', name: 'patient-id-card-create')]
    public function idCardCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $idCard = new IDCard();
        $form = $this->createForm(IDCardType::class, $idCard);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idCard = $form->getData();
            $this->patientService->saveIDCard($idCard, $patient, $isEdit);
            return $this->redirectToRoute('patient-personal-info-create', ['egn' => $egn]);
        }

        return $this->render('patient/id-card-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране на лична карта", "route" = "patient-id-card-create"}
     *     )
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/id-card-edit/{id}', name: 'patient-id-card-edit')]
    public function idCardEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(IDCardType::class, $patient->getIDCard());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $idCard = $form->getData();
            $this->patientService->saveIDCard($idCard, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'about']);
        }

        return $this->render('patient/id-card-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне на лична информация", "route" = "patient-personal-info-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/personal-info-create', name: 'patient-personal-info-create')]
    public function personalInfoCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $personalInfo = new Details();
        $form = $this->createForm(PatientDetailsType::class, $personalInfo);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personalInfo = $form->getData();
            $this->patientService->savePersonalDetails($personalInfo, $patient, $isEdit);
            return $this->redirectToRoute('patient-workplaces', ['egn' => $egn]);
        }

        return $this->render('patient/personal-info-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране на лична информация", "route" = "patient-personal-info-create"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/personal-info-edit/{id}', name: 'patient-personal-info-edit')]
    public function personalInfoEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(PatientDetailsType::class, $patient->getDetails());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $personalInfo = $form->getData();
            $this->patientService->savePersonalDetails($personalInfo, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'about']);
        }

        return $this->render('patient/personal-info-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне навици на пациента"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/habits-create', name: 'patient-habits-create')]
    public function habitsCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $form = $this->createForm(HabitsType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habits = $form->getData();
            $this->patientService->saveHabits($habits, $patient, $isEdit);
            return $this->redirectToRoute('patient-family-create', ['egn' => $egn]);
        }

        return $this->render('patient/habits-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране навици на пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/habits-edit/{id}', name: 'patient-habits-edit')]
    public function habitsEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(HabitsType::class, $patient->getHabits());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $habits = $form->getData();
            $this->patientService->saveHabits($habits, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'about']);
        }

        return $this->render('patient/habits-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне на семейното положение на пациента"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/family-create', name: 'patient-family-create')]
    public function familyCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $form = $this->createForm(FamilyType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $family = $form->getData();
            $this->patientService->saveFamily($family, $patient, $isEdit);
            return $this->redirectToRoute('patient-contacts-create', ['egn' => $egn]);
        }

        return $this->render('patient/family-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране семейното положение на пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/family-edit/{id}', name: 'patient-family-edit')]
    public function familyEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(FamilyType::class, $patient->getFamily());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $family = $form->getData();
            $this->patientService->saveFamily($family, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'about']);
        }

        return $this->render('patient/family-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Пациент", "route" = "patient-create"},{"label" = "Контакти на пацеинта", "route" = "patient-contacts-create"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/contact-create', name: 'patient-contacts-create')]
    public function patientContactsCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $contacts = new Contacts();
        $form = $this->createForm(PatientContactType::class, $contacts);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contacts = $form->getData();
            $this->patientService->saveContacts($contacts, $patient, $isEdit);

            if ('saveAndAdd' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('patient-contacts-create', ['egn' => $egn]);
            } else if ('saveAndView' === $form->getClickedButton()->getName()) {
                return $this->redirectToRoute('patient', ['id' => $patient->getId()]);
            }
        }

        return $this->render('patient/patient-contacts-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient
        ]);
    }

    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Пациент", "route" = "patient-create"},{"label" = "Контакти на пацеинта", "route" = "patient-contacts-edit"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/contact-edit/{id}', name: 'patient-contacts-edit')]
    public function patientContactsEdit(Request $request, $id): Response
    {
        $isEdit = true;
        $contact = $this->patientService->findOneContactByID($id);
        $patient = $this->patientService->findOneByID($contact->getPatient()->getId());

        $form = $this->createForm(PatientContactType::class, $contact);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $contacts = $form->getData();
            $this->patientService->saveContacts($contacts, $patient, $isEdit);

            return $this->redirectToRoute('patient', ['id' => $patient->getId()]);
        }

        return $this->render('patient/patient-contacts-edit.html.twig', [
            'form' => $form->createView(),
            'contact' => $contact
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Пациент", "route" = "patient"},{"label" = "Изтриване на пациент", "route" = "patient-contacts-delete"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/contact-delete/{id}', name: 'patient-contacts-delete')]
    public function patientContactsDelete(Request $request, $id): Response
    {
        $contact = $this->patientService->findOneContactByID($id);
        $patient = $this->patientService->findOneByID($contact->getPatient()->getId());
        $this->patientService->deleteContact($id);

        return $this->redirectToRoute('patient', ['id' => $patient->getId()]);
    }

    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Пациент", "route" = "patient"},{"label" = "Контакти на пацеинта", "route" = "patient-contacts-view-all"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/contact-view-all/{id}', name: 'patient-contacts-view-all')]
    public function patientContactsViewAll(Request $request, $id): Response
    {
        $patient = $this->patientService->findOneByID($id);
        if ($patient === null) {
            return $this->redirectToRoute('home');
        }
        $contacts = $patient->getContacts();

        return $this->render('patient/patient-contacts-view-all.html.twig', [
            'patient' => $patient,
            'contacts' => $contacts
        ]);
    }


    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},{"label" = "Всички пациенти", "route" = "all-patients"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/{id}', name: 'patient')]
    public function PatientID(Request $request, $id): Response
    {
        $patient = $this->patientService->findOneByID($id);
        $psychiatricNotes = $this->patientService->getPsychiatricNotes($patient->getId());
        $socialNotes = $this->patientService->getSocialNotes($patient->getId());
        $psychologicalNotes = $this->patientService->getPsychologicalNotes($patient->getId());
        $timeline = $this->patientService->getTimeline($id);
        return $this->render('patient/patient-view.html.twig', [
            'patient' => $patient,
            'timeline' => $timeline,
            'psychiatricNotes' => $psychiatricNotes,
            'socialNotes' => $socialNotes,
            'psychologicalNotes' => $psychologicalNotes,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param $id
     * @param Request $request
     * @param ProfilePictureUploadService $profilePictureUploadService
     * @return Response
     */
    #[Route('/profile-picture-upload', name: 'profile_picture_upload')]
    public function uploadAction($id, Request $request, ProfilePictureUploadService $profilePictureUploadService): Response
    {
        $form = $this->createForm(ProfilePictureUploadType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileData = $form['upload_file']->getData();
            $profilePictureUploadService->upload($fileData, $id);

            $message = 'test';
            return $this->json(array('username' => $message));
        }
        return $this->render('patient/profilePictureUpload.html.twig', [
            'form' => $form->createView(),
        ]);
    }


    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param $id
     * @param Request $request
     * @return Response
     */
    #[Route('/patient-report', name: 'patient_report')]
    public function addReport($id, Request $request): Response
    {
        $patient = $this->patientService->findOneByID($id);
        $form = $this->createForm(PatientReportType::class);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $report = $form->getData();
            $this->patientService->addReport($report, $patient);
        }
        return $this->render('patient/report.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Психиатрична оценка"},
     *     })
     */
    #[Route('/patient/add/psychiatric-evaluation', name: 'patient_psychiatric_evaluation')]
    public function addPatientPsychiatricEvaluation(Request $request): Response
    {

        $id = $request->query->get('id');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($patient->getPsychiatricEvaluation());
        $form = $this->createForm(PatientPsychiatricEvaluationType::class, $patient->getPsychiatricEvaluation());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->PsychiatricEvaluation($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychiatric-evaluation']);

        }
        return $this->render('patient/psychiatric-evaluation.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Психиатрична бележка"},
     *     })
     */
    #[Route('/patient/add/psychiatric-evaluation-note', name: 'patient_psychiatric_evaluation_note')]
    public function addPatientPsychiatricEvaluationNote(Request $request): Response
    {
        $id = $request->query->get('id');
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($noteID);
        if (!$isEdit) {
            $note = $this->patientService->getPsychiatricNote($noteID);
            $form = $this->createForm(PatientPsychiatricEvaluationNoteType::class, $note);
        } else {
            $form = $this->createForm(PatientPsychiatricEvaluationNoteType::class);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->PsychiatricEvaluationNote($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychiatric-evaluation']);
        }
        return $this->render('patient/psychiatric-evaluation-note.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/delete/psychiatric-evaluation-note/{id}', name: 'patient-psychiatric-evaluation-note-delete')]
    public function patientPatientPsychiatricEvaluationNoteDelete(Request $request, $id): Response
    {
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);
        $this->patientService->deletePsychiatricNote($noteID);

        return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychiatric-evaluation']);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Социална оценка"},
     *     })
     */
    #[Route('/patient/add/social-evaluation', name: 'patient_social_evaluation')]
    public function addPatientSocialEvaluation(Request $request): Response
    {

        $id = $request->query->get('id');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($patient->getSocialEvaluation());
        $form = $this->createForm(PatientSocialEvaluationType::class, $patient->getSocialEvaluation());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->SocialEvaluation($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'social-evaluation']);

        }
        return $this->render('patient/social-evaluation.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Социална бележка"},
     *     })
     */
    #[Route('/patient/add/social-evaluation-note', name: 'patient_social_evaluation_note')]
    public function addPatientSocialEvaluationNote(Request $request): Response
    {
        $id = $request->query->get('id');
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($noteID);
        if (!$isEdit) {
            $note = $this->patientService->getSocialNote($noteID);
            $form = $this->createForm(PatientSocialEvaluationNoteType::class, $note);
        } else {
            $form = $this->createForm(PatientSocialEvaluationNoteType::class);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->SocialEvaluationNote($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'social-evaluation']);
        }
        return $this->render('patient/social-evaluation-note.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/delete/social-evaluation-note/{id}', name: 'patient-social-evaluation-note-delete')]
    public function patientPatientSocialEvaluationNoteDelete(Request $request, $id): Response
    {
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);

        $this->patientService->deleteSocialNote($noteID);

        return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'social-evaluation']);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Психологическа оценка"},
     *     })
     */
    #[Route('/patient/add/psychological-evaluation', name: 'patient_psychological_evaluation')]
    public function addPsychologicalSocialEvaluation(Request $request): Response
    {
        $id = $request->query->get('id');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($patient->getPsychologicalEvaluation());
        $form = $this->createForm(PatientPsychologicalEvaluationType::class, $patient->getPsychologicalEvaluation());
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->PsychologicalEvaluation($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychological-evaluation']);

        }
        return $this->render('patient/psychological-evaluation.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Психологическа бележка"},
     *     })
     */
    #[Route('/patient/add/psychological-evaluation-note', name: 'patient_psychological_evaluation_note')]
    public function addPatientPsychologicalEvaluationNote(Request $request): Response
    {
        $id = $request->query->get('id');
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);
        $isEdit = is_null($noteID);
        if (!$isEdit) {
            $note = $this->patientService->getPsychologicalNote($noteID);
            $form = $this->createForm(PatientPsychologicalEvaluationNoteType::class, $note);
        } else {
            $form = $this->createForm(PatientPsychologicalEvaluationNoteType::class);
        }
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->PsychologicalEvaluationNote($formFields, $patient, !$isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychological-evaluation']);
        }
        return $this->render('patient/psychological-evaluation-note.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/delete/psychological-evaluation-note/{id}', name: 'patient-psychological-evaluation-note-delete')]
    public function patientPatientPsychologicalEvaluationNoteDelete(Request $request, $id): Response
    {
        $noteID = $request->query->get('noteID');
        $patient = $this->patientService->findOneByID($id);

        $this->patientService->deletePsychologicalNote($noteID);

        return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'psychological-evaluation']);
    }


    /**
     * @IsGranted("ROLE_DOCTOR")
     * @param Request $request
     * @return Response
     * @Breadcrumb({
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Всички пациенти", "route" = "all-patients"},
     *     {"label" = "Температурен лист"},
     *     })
     */
    #[Route('/patient/add/temperature-list', name: 'patient_temperature_list')]
    public function addTemperatureList(Request $request): Response
    {
        $isEdit = false;
        $id = $request->query->get('id');
        $patient = $this->patientService->findOneByID($id);
        $temperatureList = new TemperatureList();

        $form = $this->createForm(TemperatureListType::class, $temperatureList);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->addTemperatureList($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'temperature-line']);
        }

        return $this->render('patient/temperatureList.html.twig', [
            'form' => $form->createView(),
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне на работни позиции за пациента"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/add/workplaces', name: 'patient-workplaces')]
    public function workplacesCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $workplaces = new Workplaces();
        $form = $this->createForm(WorkplacesType::class, $workplaces);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->workplaces($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient-schools', ['egn' => $egn]);
        } else {
            $errors = (string)$form->getErrors(true, false);
            // $formFields = $form->getData();
            // print_r($errors);
            //  print_r($formFields->toString());
        }

        return $this->render('patient/workplaces-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране на работни позиции за пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/edit/workplace/{id}', name: 'patient-workplace-edit')]
    public function workplaceEdit(Request $request, $id): Response
    {
        $isEdit = !($id == 0);
        $patientID = $request->query->get('patientID');
        $patient = $this->patientService->findOneByID($patientID);
        $workplace = $id == 0 ? new Workplace() : $this->patientService->getWorkplace($id);

        $form = $this->createForm(WorkplaceType::class, $workplace);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->workplace($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'workplaces']);
        }

        return $this->render('patient/workplace.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
            'workplace' => $workplace
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Премахване на работни позиции за пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/remove/workplace/{id}', name: 'patient-workplace-remove')]
    public function workplaceRemove(Request $request, $id): Response
    {
        $patientID = $request->query->get('patientID');
        $patient = $this->patientService->findOneByID($patientID);
        $workplace = $this->patientService->getWorkplace($id);
        $this->patientService->removeWorkplace($workplace);
        return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'workplaces']);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне на образователни институции за пациента"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/add/schools', name: 'patient-schools')]
    public function schoolsCreate(Request $request): Response
    {
        $isEdit = false;
        $egn = $request->query->get('egn');
        $patient = $this->patientService->findOneByEGN($egn);
        $schools = new Schools();
        $form = $this->createForm(SchoolsType::class, $schools);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->schools($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient-habits-create', ['egn' => $egn]);
        }

        return $this->render('patient/schools-create.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Редактиране на образователни институции за пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/edit/school/{id}', name: 'patient-school-edit')]
    public function schoolEdit(Request $request, $id): Response
    {
        $isEdit = !($id == 0);
        $patientID = $request->query->get('patientID');
        $patient = $this->patientService->findOneByID($patientID);
        $school = $id == 0 ? new School() : $this->patientService->getSchool($id);

        $form = $this->createForm(SchoolType::class, $school);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->school($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'schools']);
        }

        return $this->render('patient/school.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit,
            'school' => $school
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Премахване на образователни институции за пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/remove/school/{id}', name: 'patient-school-remove')]
    public function schoolRemove(Request $request, $id): Response
    {
        $patientID = $request->query->get('patientID');
        $patient = $this->patientService->findOneByID($patientID);
        $school = $this->patientService->getSchool($id);
        $this->patientService->removeSchool($school);
        return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'school']);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Добавяне на алергия на пациента"})
     * @param Request $request
     * @return Response
     */
    #[Route('/patient/add/allergy', name: 'patient-allergy')]
    public function allergy(Request $request): Response
    {
        $egn = $request->query->get('egn');
        $edit = $request->query->get('edit');
        $allergyID = $request->query->get('id');
        $isEdit = $edit === "yes";
        $patient = $this->patientService->findOneByEGN($egn);
        $allergy = $isEdit?$this->patientService->getAllergy($allergyID):new Allergy();
        $form = $this->createForm(AllergyType::class, $allergy);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $formFields = $form->getData();
            $this->patientService->allergy($formFields, $patient, $isEdit);
            return $this->redirectToRoute('patient', ['id' => $patient->getId(), '_fragment' => 'timeline']);
        }

        return $this->render('patient/allergy.html.twig', [
            'form' => $form->createView(),
            'patient' => $patient,
            'isEdit' => $isEdit
        ]);
    }

    /**
     * @IsGranted("ROLE_DOCTOR")
     * @Breadcrumb(
     *     {"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient-create"},
     *     {"label" = "Премахване на алергия за пациента"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/remove/allergy/{id}', name: 'patient-allergy-remove')]
    public function allergyRemove(Request $request, $id): Response
    {
        $allergy = $this->patientService->getAllergy($id);
        $patient = $this->patientService->findOneByID($allergy->getPatient()->getId());
        $this->patientService->allergyRemove($allergy);

        return $this->redirectToRoute('patient', ['id' => $patient->getId()]);
    }

    /**
     * @Breadcrumb({"label" = "Начало", "route" = "home"},
     *     {"label" = "Пациент", "route" = "patient"},
     *     {"label" = "Алергии на пацеинта", "route" = "patient-allergy-all"})
     * @param Request $request
     * @param $id
     * @return Response
     */
    #[Route('/patient/allergy-all/{id}', name: 'patient-allergy-all')]
    public function allergyAll(Request $request, $id): Response
    {
        $patient = $this->patientService->findOneByID($id);
        if ($patient === null) {
            return $this->redirectToRoute('home');
        }
        $allAllergy = $patient->getAllergies();

        return $this->render('patient/patient-allergy-all.html.twig', [
            'patient' => $patient,
            'allAllergy' => $allAllergy
        ]);
    }

}
