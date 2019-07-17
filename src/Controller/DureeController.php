<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
    /**
     * @Route("/duree", name="duree", methods="GET")
     */
class DureeController extends AbstractController
{
    /*
    * @Route("/")
    */
    public function index()
    {
        return $this->render('duree/index.html.twig', [
            'controller_name' => 'DureeController',
        ]);
    }
}
