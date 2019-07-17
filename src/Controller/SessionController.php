<?php

namespace App\Controller;


use App\Entity\Duree;
use App\Entity\Session;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/")
 */
class SessionController extends AbstractController
{

    /**
     * @Route("/", name="session_index", methods="GET")
     */
    public function indexSession()
    {
        $sessions = $this->getDoctrine()
        ->getRepository(Session::class)
        ->getAll();

        return $this->render('session/index.html.twig', [
            'sessions' => $sessions
        ]);
    }

    
    /**
     * @Route("sessionshow/{id}", name="session_show", methods="GET")
     */
    public function showSession(Session $session): Response {

        $durees = $this->getDoctrine()->getRepository(Duree::class)->findBy(["dureeIntoSession" => $session->getId()]);
      
        return $this->render('session/show.html.twig',[

            'session' => $session,
            'durees' => $durees

        ]);
    }




}

