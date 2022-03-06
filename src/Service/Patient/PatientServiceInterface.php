<?php

namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;
use App\Entity\Patient\PsychiatricEvaluation;
use App\Entity\Patient\Report;
use App\Entity\Patient\SocialEvaluation;

interface PatientServiceInterface
{

    public function save(Patient $patient): string;

    public function edit(Patient $patient): bool;

    public function findAll(): array;

    public function findOneByEGN($egn): ?Patient;

    public function findOneByID($id): ?Patient;

    public function saveIDCard(IDCard $IDCard, Patient $patient);

    public function savePersonalDetails(Details $details, Patient $patient);

    public function saveContacts(Contacts $contacts, Patient $patient, $isEdit);

    public function findByEGN($EGN);

    public function addReport(Report $report, Patient $patient): bool;

    public function addPsychiatricEvaluation(PsychiatricEvaluation $psychiatricEvaluation, Patient $patient): bool;

    public function getTimeline($id): array;

    public function findOneContactByID($id): ?Contacts;

    public function deleteContact(int $id);

    public function addSocialEvaluation(SocialEvaluation $socialEvaluation , Patient $patient): void;

}
