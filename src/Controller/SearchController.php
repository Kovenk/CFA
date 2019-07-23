<?php

namespace App\Controller;

use App\Entity\Module;
use App\Entity\Session;
use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Stagiaire;
use App\Form\AdvencedSearchType;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{

    /**
     * @Route("/search", name="search")
     */
    public function search(Request $request, ObjectManager $em){

        $results = null;
        $form = $this->createForm(AdvencedSearchType::class);

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){  
            $query = $form->get('recherche')->getData();
            $type = $form->get('type')->getData();

            switch($type){
                case 'categorie':
                    $repo = $em->getRepository(Categorie::class);
                    break;
                case 'formateur':
                    $repo = $em->getRepository(Formateur::class);
                    break;
                case 'session':
                    $repo = $em->getRepository(Session::class);
                    break;
                    case 'module':
                    $repo = $em->getRepository(Module::class);
                    break;                
                case 'stagiaire':
                    $repo = $em->getRepository(Stagiaire::class);
                    break;
                    $results = $repo->search($query);
                default:
                    return $this->redirectToRoute("search");


                    break;
            }
            $results = $repo->search($query);
        }

        return $this->render('search/result.html.twig', [
            'search_form' => $form->createView(),
            'results' => $results
            
        ]); 
        
    }

    
}


