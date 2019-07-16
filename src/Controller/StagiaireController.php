<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
* @Route("/stagiaire")
*/
class StagiaireController extends AbstractController
{

    /**
     * @Route("/", name="stagiaire_index", methods="GET")
     */
    public function indexStagiaire()
    {
        $stagiaires = $this->getDoctrine()
        ->getRepository(Stagiaire::class)
        ->getAll();

        return $this->render('stagiaire/index.html.twig', [
            'stagiaires' => $stagiaires
        ]);
    }

    /**
     * @Route("/{id}", name="stagiaire_show", methods="GET")
     */
    public function showStagiaire(Stagiaire $stagiaire): Response {
        return $this->render('stagiaire/show.html.twig',[
            'stagiaire' => $stagiaire
        ]);
    }




}
