<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DureeController extends AbstractController
{
    /**
     * @Route("/duree", name="duree")
     */
    public function index()
    {
        return $this->render('duree/index.html.twig', [
            'controller_name' => 'DureeController',
        ]);
    }
}
