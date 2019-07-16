<?php

namespace App\Controller;

use App\Entity\Formateur;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/formateur")
 */
class FormateurController extends AbstractController
{

    /**
     * @Route("/", name="formateur_index", methods="GET")
     */
    public function indexFormateur()
    {
        $formateurs = $this->getDoctrine()
        ->getRepository(Formateur::class)
        ->getAll();

        return $this->render('formateur/index.html.twig', [
            'formateurs' => $formateurs
        ]);
    }

    
    /**
     * @Route("/{id}", name="formateur_show", methods="GET")
     */
    public function showFormateur(Formateur $formateur): Response {
        return $this->render('formateur/show.html.twig',[
            'formateur' => $formateur
        ]);
    }
}
