<?php

namespace App\Controller;

use App\Entity\Patient\Patient;
use App\Service\Patient\PatientServiceInterface;
use SlopeIt\BreadcrumbBundle\Annotation\Breadcrumb;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
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

    /**
     * Creates a new ActionItem entity.
     */
    #[Route('/search', name: 'ajax_search',methods: ['GET'])]
    public function searchAction(Request $request)
    {
        $requestString = $request->get('q');

        $entities =  $this->patientService->findByEGN($requestString);

        if(!$entities) {
            $result['entities']['error'] = "Не е открит резултат!";
        } else {
            $result['entities'] = $this->getRealEntities($entities);
        }

        return new Response(json_encode($result));
    }

    /**
     * @param $entities
     * @return array
     */
    public function getRealEntities($entities): array
    {

        foreach ($entities as $entity){
            $realEntities[$entity->getId()] = $entity->getFirstName()." ".$entity->getLastName()." ".$entity->getEGN()." ".$entity->getPatientID();
        }

        return $realEntities;
    }
}