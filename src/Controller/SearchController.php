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
            $dateDebut = null;
            $dateFin = null;
                        
            $error = false;
            switch($type){
                case 'categorie':
                    $repo = $em->getRepository(Categorie::class);
                    break;
                case 'formateur':
                    $repo = $em->getRepository(Formateur::class);
                    break;
                case 'session':
                    $dateDebut = $form->get('begindate')->getData();
                    $dateFin = $form->get('enddate')->getData();
                    $repo = $em->getRepository(Session::class);
                    if ($dateDebut > $dateFin){
                        $error = true;
                        $this->addFlash('danger', 'Veuillez respecter la logique des dates! Une date de debut ne peut pas être supérieur une date de fin');
                    }
                    break;
                    case 'module':
                    $repo = $em->getRepository(Module::class);
                    break;                
                case 'stagiaire':
                    $repo = $em->getRepository(Stagiaire::class);
                    break;
                    //$results = $repo->search($query);
                default:
                    return $this->redirectToRoute("search");
                    break;
            }
            if(!$error){
                $results = $repo->search($query, $dateDebut, $dateFin);
            }
           
        }

        return $this->render('search/result.html.twig', [
            'search_form' => $form->createView(),
            'results' => $results
            
        ]); 
        
    }

    
}


