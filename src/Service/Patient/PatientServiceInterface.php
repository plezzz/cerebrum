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
use App\Entity\Patient\School;
use App\Entity\Patient\Schools;
use App\Entity\Patient\SocialEvaluation;
use App\Entity\Patient\SocialEvaluationNote;
use App\Entity\Patient\TemperatureList;
use App\Entity\Patient\Workplace;
use App\Entity\Patient\Workplaces;

interface PatientServiceInterface
{

    public function save(Patient $patient,bool $isEdit): string;

    public function edit(Patient $patient): bool;

    public function findAll(): array;

    public function findOneByEGN($egn): ?Patient;

    public function findOneByID($id): ?Patient;

    public function saveIDCard(IDCard $IDCard, Patient $patient,bool $isEdit);

    public function savePersonalDetails(Details $details, Patient $patient,bool $isEdit);

    public function saveContacts(Contacts $contacts, Patient $patient, $isEdit);

    public function findByEGN($EGN);

    public function addReport(Report $report, Patient $patient): bool;

    public function getTimeline($id): array;

    public function findOneContactByID($id): ?Contacts;

    public function deleteContact(int $id);

    public function PsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation, Patient $patient, bool $isEdit): bool;

    public function PsychiatricEvaluationNote(PsychiatricEvaluationNote $psychiatricEvaluationNote, Patient $patient, bool $isEdit): void;

    public function getPsychiatricNotes($id): array;

    public function getPsychiatricNote($id): ?PsychiatricEvaluationNote;

    public function deletePsychiatricNote(int $id): void;

    public function SocialEvaluation(SocialEvaluation $socialEvaluation, Patient $patient, bool $isEdit): void;

    public function SocialEvaluationNote(SocialEvaluationNote $socialEvaluationNote, Patient $patient, bool $isEdit): void;

    public function getSocialNotes($id): array;

    public function getSocialNote($id): ?SocialEvaluationNote;

    public function deleteSocialNote(int $id): void;

    public function PsychologicalEvaluation(PsychologicalEvaluation $socialEvaluation, Patient $patient, bool $isEdit): void;

    public function PsychologicalEvaluationNote(PsychologicalEvaluationNote $socialEvaluationNote, Patient $patient, bool $isEdit): void;

    public function getPsychologicalNotes($id): array;

    public function getPsychologicalNote($id): ?PsychologicalEvaluationNote;

    public function deletePsychologicalNote(int $id): void;

    public function saveHabits(Habits $habits, Patient $patient, $isEdit): ?int;

    public function saveFamily(Family $family, Patient $patient, $isEdit): ?int;

    public function addTemperatureList(TemperatureList $temperatureList,Patient $patient,bool $isEdit):void;

    public function getTemperatureList($id): array;

    public function workplaces(Workplaces $workplaces, Patient $patient,bool $isEdit): void;

    public function getWorkplace($id): Workplace|null;

    public function workplace(Workplace $workplace, Patient $patient, bool $isEdit): void;

    public function removeWorkplace($workplace): void;

    public function schools(Schools $schools, Patient $patient,bool $isEdit): void;

    public function getSchool($id): School|null;

    public function school(School $school, Patient $patient, bool $isEdit): void;

    public function removeSchool($school): void;
}
