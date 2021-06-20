<?php

namespace App\Service\Common;

use App\Entity\FileUpload;
use App\Repository\FileUploadRepository;
use App\Service\Patient\PatientService;
use App\Service\User\UserService;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;
use Symfony\Component\String\Slugger\SluggerInterface;


class FileUploadService
{
    private $targetDirectory;
    private $slugger;
    private $fileUploadRepository;
    private $dateTimeService;
    private $userService;
    private $patientService;

    public function __construct(
        $targetDirectory,
        SluggerInterface $slugger,
        FileUploadRepository $fileUploadRepository,
        DateTimeService $dateTimeService,
        UserService $userService,
        PatientService $patientService
    )
    {
        $this->dateTimeService = $dateTimeService;
        $this->fileUploadRepository = $fileUploadRepository;
        $this->targetDirectory = $targetDirectory;
        $this->slugger = $slugger;
        $this->userService = $userService;
        $this->patientService = $patientService;
    }

    public function upload(UploadedFile $file, FileUpload $fileDB, $patientID)
    {
        $originalFilename = pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME);
        $safeFilename = $this->slugger->slug($originalFilename);
        $fileName = $this->dateTimeService->setDateNow() . '-' . $safeFilename . '-' . uniqid() . '.' . $file->guessExtension();

        $mime = explode('/', $file->getMimeType());
        $user = $this->userService->currentUser();
        $patient = $this->patientService->findOneByID($patientID);

        $fileDB->setOriginalName($file->getClientOriginalName());
        $fileDB->setExtension($file->guessExtension());
        $fileDB->setType($mime);
        $fileDB->setName($fileName);
        $fileDB->setCreatedAt($this->dateTimeService->setDateTimeNow());
        $fileDB->setCreatedBy($user);
        $fileDB->setPatient($patient);

        try {
            $file->move($this->getTargetDirectory(), $fileName);
            $this->fileUploadRepository->insert($fileDB);
        } catch (FileException $e) {
            // ... handle exception if something happens during file upload
            return null; // for example
        }
        return $fileName;
    }

    public function getTargetDirectory()
    {
        return $this->targetDirectory;
    }
}
