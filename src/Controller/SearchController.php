<?php

namespace App\Controller;

use App\Service\Patient\PatientServiceInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class SearchController extends AbstractController
{
    private PatientServiceInterface $patientService;

    public function __construct(PatientServiceInterface $patientService)
    {
        $this->patientService = $patientService;
    }

    #[Route('/search', name: 'search')]
    public function index(Request $request): Response
    {


        $requestString = $request->query->get('q');

        $entities = $this->patientService->findByEGN($requestString);

        if (!$entities) {
            $result['entities']['error'] = "keine Einträge gefunden";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    public function getRealEntities($entities){

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getFirstName();
        }

        return $realEntities;
    }

}
