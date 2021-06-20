<?php

namespace App\Controller;

use App\Entity\FileUpload;
use App\Form\UploadType;
use App\Service\Common\FileUploadService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FileUploadController extends AbstractController
{

    /**
     * @param $id
     * @param Request $request
     * @param FileUploadService $file_uploader
     * @return Response
     */
    #[Route('/file-upload', name: 'file_upload')]
    public function uploadAction($id, Request $request, FileUploadService $file_uploader): Response
    {
        $file = new FileUpload();
        $form = $this->createForm(UploadType::class, $file);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $fileData = $form['upload_file']->getData();
            $file = $form->getData();
            $file_uploader->upload($fileData, $file, $id);
        }
        return $this->render('patient/fileUpload.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
