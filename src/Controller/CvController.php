<?php

namespace App\Controller;

use App\Form\CvType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * @Route("/cv")
 */
class CvController extends AbstractController
{
    /**
     * @Route("/list", name="cv-list")
     */
    public function index(): Response
    {
        return $this->render('cv/index.html.twig', [
            'controller_name' => 'CvController',
        ]);
    }

    /**
     * @Route("/create", name="cv-create")
     */
    public function create(Request $request): Response
    {

        $form = $this->createForm(CvType::class);
        $form->handleRequest($request);

        return $this->render('cv/create.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
