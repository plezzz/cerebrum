<?php

namespace App\Controller;


use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


class HomeController extends AbstractController
{
//    private $userService;
//    private $dateTimeService;
//    private $patientService;
//
//    public function __construct(UserServiceInterface $userService, DateTimeServiceInterface $dateTimeService, PatientServiceInterface $patientService)
//    {
//        $this->patientService = $patientService;
//        $this->dateTimeService = $dateTimeService;
//        $this->userService = $userService;
//    }

    #[Route('/home', name: 'home')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
