<?php

namespace App\Controller;

use SearchRepository;
use App\Form\AdvencedSearchType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class SearchController extends AbstractController
{

    /**
     * @Route("/search", name="search")
     */
    public function  search(){

        $advencedSearchForm = $this->createForm(AdvencedSearchType::class);

        // if($advencedSearchForm->handleRequest($request)->isSubmitted() && $advencedSearchForm->isValid()){
        //     $criteres = $advencedSearchForm->getData();
        //     dd($criteres);
        //     $search = $searchRepository->search($criteres;    
        return $this->render('search/result.html.twig', [
            'search_form' => $advencedSearchForm->createView(),
        ]); 
        
    }

    
}


