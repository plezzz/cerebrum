<?php

namespace App\Service\Patient;


use App\Entity\Patient\Contacts;
use App\Entity\Patient\Details;
use App\Entity\Patient\IDCard;
use App\Entity\Patient\Patient;

interface PatientServiceInterface
{

    public function save(Patient $patient): string;

    public function findAll(): array;

    public function findOneByEGN($egn): ?Patient;

    public function findOneByID($id): ?Patient;

    public function saveIDCard(IDCard $IDCard, Patient $patient);

    public function savePersonalDetails(Details $details, Patient $patient);

    public function saveContacts(Contacts $contacts, Patient $patient);



}
