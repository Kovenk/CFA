<?php

namespace App\Controller;

use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/admin")
 */
class AdminController extends AbstractController
{


    /**
    * @Route("/", name="admin_index")
    */
    public function index()
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }




    
    /**
    * @Route("/addStagiaire", name="stagiaire_add") 
    */
    public function addStagiaire(Request $request, ObjectManager $manager){

        $stagiaire = new Stagiaire();

        $form = $this->createFormBuilder($stagiaire)
        ->add('prenom',TextType::class)
        ->add('nom',TextType::class)
        ->add('dateNaissance',DateType::class)
        ->add('telephone',TextType::class)
        ->add('mail',TextType::class)
        ->add('adresse',TextType::class)
        ->add('ville',TextType::class)
        ->add('codePostal',TextType::class)

        ->add('Valider',SubmitType::class)
        
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($stagiaire);
            $manager->flush();
            return $this->redirectToRoute("stagiaire_index");
        }
        
        return $this->render('stagiaire/add.html.twig',[
            'form' => $form->createView()
        ]);

    }


    /** 
    * @Route("/stagiaire/{id}/delete", name="stagiaire_delete")
    */
    public function deleteStagiaire(Stagiaire $stagiaire, ObjectManager $manager){

        $manager->remove($stagiaire);
        $manager->flush();

        return $this->redirectToRoute("stagiaire_index");

    }

    /**
    * @Route("/addFormateur", name="formateur_add") 
    */
    public function addFormateur(Request $request, ObjectManager $manager){

        $formateur = new Formateur();

        $form = $this->createFormBuilder($formateur)
        ->add('prenom',TextType::class)
        ->add('nom',TextType::class)
        ->add('dateNaissance',DateType::class)
        ->add('telephone',TextType::class)
        ->add('mail',TextType::class)
        ->add('adresse',TextType::class)
        ->add('ville',TextType::class)
        ->add('codePostal',TextType::class)

        ->add('Valider',SubmitType::class)
        
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($formateur);
            $manager->flush();
            return $this->redirectToRoute("formateur_index");
        }
        
        return $this->render('formateur/add.html.twig',[
            'form' => $form->createView()
        ]);

    }


    /** 
    * @Route("/stagiaire/{id}/delete", name="stagiaire_delete")
    */
    public function deleteStagiaire(Stagiaire $stagiaire, ObjectManager $manager){

        $manager->remove($stagiaire);
        $manager->flush();

        return $this->redirectToRoute("stagiaire_index");

    }


}
