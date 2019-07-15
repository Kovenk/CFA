<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class StagiaireController extends AbstractController
{
    /**
     * @Route("/stagiaire", name="stagiaire")
     */
    public function index()
    {
        return $this->render('stagiaire/index.html.twig', [
            'controller_name' => 'StagiaireController',
        ]);
    }
}
