<?php

namespace App\Controller;

use App\Entity\Categorie;
use App\Entity\Duree;
use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Formateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;


/**
 * @Route("/session")
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
     * @Route("/{id}", name="session_show", methods="GET")
     */
    public function showSession(Session $session, Duree $duree, Module $module, Formateur $formateur, Categorie $categorie): Response {


        $duree = $this->getDoctrine()
        ->getRepository(Duree::class)
        ->findAll();

        $module = $this->getDoctrine()
        ->getRepository(Module::class)
        ->findAll();

        $formateur = $this->getDoctrine()
        ->getRepository(Formateur::class)
        ->findAll();

        $categorie = $this->getDoctrine()
        ->getRepository(Categorie::class)
        ->findAll();



        return $this->render('session/show.html.twig',[
            'session' => $session,
            'duree' => $duree,
            'module' => $module,
            'formateur' => $formateur,
            'categorie' => $categorie
        ]);
    }




}

