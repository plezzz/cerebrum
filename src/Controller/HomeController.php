<?php

namespace App\Controller;

use App\Entity\FileUpload;
use App\Service\Common\DateTimeService;
use App\Service\Common\DateTimeServiceInterface;
use App\Service\Patient\PatientServiceInterface;
use App\Service\User\UserServiceInterface;
use phpDocumentor\Reflection\Types\This;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Uploader;


class HomeController extends AbstractController
{
    private $userService;
    private $dateTimeService;
    private $patientService;

    public function __construct(UserServiceInterface $userService, DateTimeServiceInterface $dateTimeService, PatientServiceInterface $patientService)
    {
        $this->patientService = $patientService;
        $this->dateTimeService = $dateTimeService;
        $this->userService = $userService;
    }

    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    #[Route('/uploadDocument', name: 'uploadDocument')]
    public function uploadDocument(Request $request): Response
    {
//        include('./class.uploader.php');

        $uploader = new Uploader();
        $data = $uploader->upload($_FILES['files'], array(
            'limit' => 10, //Maximum Limit of files. {null, Number}
            'maxSize' => 10, //Maximum Size of files {null, Number(in MB's)}
            'extensions' => null, //Whitelist for file extension. {null, Array(ex: array('jpg', 'png'))}
            'required' => false, //Minimum one file is required for upload {Boolean}
            'uploadDir' => './uploads/', //Upload directory {String}
            'title' => "name", //New file name {null, String, Array} *please read documentation in README.md
            'removeFiles' => true, //Enable file exclusion {Boolean(extra for jQuery.filer), String($_POST field name containing json data with file names)}
            'replace' => true, //Replace the file if it already exists  {Boolean}
            'perms' => null, //Uploaded file permisions {null, Number}
            'onCheck' => null, //A callback function name to be called by checking a file for errors (must return an array) | ($file) | Callback
            'onError' => null, //A callback function name to be called if an error occured (must return an array) | ($errors, $file) | Callback
            'onSuccess' => null, //A callback function name to be called if all files were successfully uploaded | ($files, $metas) | Callback
            'onUpload' => null, //A callback function name to be called if all files were successfully uploaded (must return an array) | ($file) | Callback
            'onComplete' => null, //A callback function name to be called when upload is complete | ($file) | Callback
            'onRemove' => null //A callback function name to be called by removing files (must return an array) | ($removed_files) | Callback
        ));

        if ($data['isComplete']) {
            //file_put_contents('test.json', json_encode($data['data']));
            $info = $data['data'];

            echo '<pre>';
            print_r($info);
            echo '</pre>';
            $entityManager = $this->getDoctrine()->getManager();

            $patient = explode('/', $_SERVER['HTTP_REFERER']);
            $file = new FileUpload();
            $file->setName($data['data']['metas'][0]['name']);
            $file->setCreatedBy($this->userService->currentUser());
            $file->setCreatedAt($this->dateTimeService->setDateTimeNow());
            $file->setPatient($this->patientService->findOneByID($patient[4]));
            $file->setType($data['data']['metas'][0]['type']);

            $entityManager->persist($file);
            $entityManager->flush();
        }

        if ($data['hasErrors']) {
            $errors = $data['errors'];
            print_r($errors);
        }

        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);

    }

    private function getRequest()
    {
    }
}
