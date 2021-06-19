<?php

namespace App\Service\Patient;

use App\Entity\FileUpload;
use App\Repository\FileUploadRepository;
use App\Service\Common\DateTimeService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


class ProfilePictureUploadService
{
    private $targetDirectory;
    private $slugger;
    private $dateTimeService;

    public function __construct(
        $targetDirectory,
        SluggerInterface $slugger,
        FileUploadRepository $fileUploadRepository,
        PatientService $patientService,
        DateTimeService $dateTimeService,
    )
    {
        $this->fileUploadRepository = $fileUploadRepository;
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->patientService = $patientService;
        $this->dateTimeService = $dateTimeService;
    }
    public function upload(UploadedFile $file,$patientID)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $this->dateTimeService->setDateNow().'-'.$safeFilename.'-'.uniqid().'.'.$file->guessExtension();
        $patient = $this->patientService->findOneByID($patientID);
        $patient->setProfilePicture($fileName);
        try {
            $file->move($this->getTargetDirectory(), $fileName);
            $this->patientService->edit($patient);
        } catch (FileException $e) {
            return null;
        }
        return $fileName;
    }
    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
