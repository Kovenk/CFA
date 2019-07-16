<?php

namespace App\Controller;

use App\Entity\Categorie;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/categorie")
 */
class CategorieController extends AbstractController
{

    /**
     * @Route("/", name="categorie_index", methods="GET")
     */
    public function indexCategorie()
    {
        $categories = $this->getDoctrine()
        ->getRepository(Categorie::class)
        ->getAll();

        return $this->render('categorie/index.html.twig', [
            'categories' => $categories
        ]);
    }

    
    /**
     * @Route("/{id}", name="categorie_show", methods="GET")
     */
    public function showCategorie(Categorie $categorie): Response {
        return $this->render('categorie/show.html.twig',[
            'categorie' => $categorie
        ]);
    }
}
