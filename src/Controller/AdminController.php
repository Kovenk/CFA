<?php

namespace App\Controller;

use App\Entity\Duree;
use App\Entity\Module;
use App\Entity\Session;
use App\Form\DureeType;
use App\Entity\Categorie;
use App\Entity\Formateur;
use App\Entity\Stagiaire;
use App\Form\ModulesType;
use App\Form\SessionType;
use FontLib\TrueType\Collection;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\CollectionType;
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


/**----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------MODULE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/





     /**
    * @Route("/addModule/{id}", name="module_add") 
    */
    public function addModule(Categorie $categorie, Request $request, ObjectManager $manager){

        $module = new Module();

        $form = $this->createFormBuilder($module)

        // ->setAction($this->generateUrl("module_add"))


        ->add('theme', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'intitule',
            'placeholder' => $categorie
        ])
                ->add('intitule',TextType::class)
        ->add('Valider',SubmitType::class)
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($module);
            $manager->flush();
            return $this->redirectToRoute("module_index");
        }
        
        return $this->render('module/add.html.twig',[
            'form' => $form->createView(),
            'categorie' => $categorie
        ]);
    }

    /**
    * @Route("/addModuleAlone/", name="module_addalone") 
    */
    public function addModuleAlone(Request $request, ObjectManager $manager){

        $module = new Module();

        $form = $this->createFormBuilder($module)

        // ->setAction($this->generateUrl("module_add"))


        ->add('theme', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'intitule',
            'placeholder' => 'Dans quelle catégorie voulez vous inserer le module'
        ])
        ->add('intitule',TextType::class)
        ->add('Valider',SubmitType::class)
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($module);
            $manager->flush();
            return $this->redirectToRoute("module_index");
        }
        
        return $this->render('module/addAlone.html.twig',[
            'form' => $form->createView()
        ]);
    }




    /**
     * @Route("/module/{id}/edit", name="module_edit")
     */
    public function editModule(Module $module = null, Request $request, ObjectManager $manager){

        $form = $this->createFormBuilder($module)
        ->add('intitule',TextType::class)
        ->add('theme', EntityType::class, [
            'class' => Categorie::class,
            'choice_label' => 'intitule',
        ])
        ->add('Valider',SubmitType::class)
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->flush();
            return $this->redirectToRoute("module_index");
        }
        
        return $this->render('module/add.html.twig',[
            'form' => $form->createView(),
        ]);
   
    }

     /** 
    * @Route("/module/{id}/delete", name="module_delete")
    */
    public function deleteModule(Module $module, ObjectManager $manager){

        $manager->remove($module);
        $manager->flush();

        return $this->redirectToRoute("module_index");

    }




/**----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------CATEGORIE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



        /**
    * @Route("/addCategorie", name="categorie_add") 
    */
    public function addCategorie(Request $request, ObjectManager $manager){

        $categorie = new Categorie();

        $form = $this->createFormBuilder($categorie)

        ->setAction($this->generateUrl("categorie_add"))

        ->add('intitule',TextType::class)
        ->add('Valider',SubmitType::class)
        ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($categorie);
            $manager->flush();
            return $this->redirectToRoute("module_add", ['id' => $categorie->getId()]);
        }
        
        return $this->render('categorie/add.html.twig',[
            'form' => $form->createView()
        ]);
    }





        /**
     * @Route("/categorie/{id}/edit", name="categorie_edit")
     */
    public function editCategorie(Categorie $categorie = null, Request $request, ObjectManager $manager){

        $form = $this->createFormBuilder($categorie)
        ->add('intitule',TextType::class)


        ->add('Valider',SubmitType::class)
        
        ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->flush();
            return $this->redirectToRoute("categorie_show", ['id' => $categorie->getId()]);
        }
        

        return $this->render('categorie/add.html.twig',[
            'form' => $form->createView(),
        ]);
   
    }


      /** 
    * @Route("/categorie/{id}/delete", name="categorie_delete")
    */
    public function deleteCategorie(Categorie $categorie, ObjectManager $manager){

        $manager->remove($categorie);
        $manager->flush();

        return $this->redirectToRoute("categorie_index");

    }

/**----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------SESSION---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/

    /**
     * @Route("sessionModule/", name="duree_add")
     */
    public function addDuree(Request $request, ObjectManager $manager){

        $duree = new Duree();

        $form = $this->createFormBuilder($duree)
            ->add('dureeIntoSession', EntityType::class, [
                'class' => Session::class,
                'choice_label' => 'intitule',
                ])
            ->add('nbJour',TextType::class)
            ->add('dureeIntoModule', EntityType::class, [
                'class' => Module::class,
                'choice_label' => 'intitule',
                ])
        
            ->add('Valider',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($duree);
            $manager->flush();
            return $this->redirectToRoute("session_index");
        }
        
        return $this->render('duree/add.html.twig',[
            'form' => $form->createView()
        ]);
    }

/**
 * @Route("/newsession", name="new_session")
 */
public function newSession(){
    return $this->render('session/new.html.twig');
}
    
    /**
    * @Route("/addSession", name="session_add") 
    */
    public function addSession(Request $request, ObjectManager $manager){

        $session = new Session();

        $form = $this->createFormBuilder($session)

            ->setAction($this->generateUrl("session_add"))

            ->add('intitule',TextType::class)
            ->add('dateDebut',DateType::class)
            ->add('dateFin',DateType::class)
            ->add('placeTotale',TextType::class)
        
            ->add('Valider',SubmitType::class)
            
            ->getForm();

        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            $manager->persist($session);
            $manager->flush();
            return $this->redirectToRoute("add_module", ['id' => $session->getId()]);
        }
        
        return $this->render('session/add.html.twig',[
            'form' => $form->createView()
        ]);

    }

    /**
     * @Route("session/{id}/edit", name="session_edit")
     */
    public function editSession(Session $session = null, Request $request, ObjectManager $manager){

        $form = $this->createFormBuilder($session)
            ->add('intitule',TextType::class)
            ->add('dateDebut',DateType::class)



            ->add('dateFin',DateType::class)
            ->add('placeTotale',TextType::class)
            ->add('Valider',SubmitType::class)
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->flush();
            return $this->redirectToRoute("session_show", ['id' => $session->getId()]);
        }
        

        return $this->render('session/add.html.twig',[
            'form' => $form->createView(),
        ]);
   
    }

    /** 
    * @Route("/session/{id}/delete", name="session_delete")
    */
    public function deleteSession(Session $session, ObjectManager $manager){

        $manager->remove($session);
        $manager->flush();

        return $this->redirectToRoute("session_index");

    }




    /**
    * @Route("/inscription/{id}", name="inscription") 
    */
    public function inscription(Session $session,Request $request, ObjectManager $manager){

        $form = $this->createForm(SessionType::class, $session);
        $form->handleRequest($request);


        if($form->isSubmitted() && $form->isValid()){    
            
            
            $manager->flush();
            return $this->redirectToRoute("session_index");
        }
        
        return $this->render('session/inscription.html.twig',[
            'form' => $form->createView(),
            'session' => $session
        ]);

    }


    /**
    * @Route("/moduleAdd/{id}", name="add_module") 
    */
    public function addModuleInSession(Session $session, Request $request, ObjectManager $manager){

        $form = $this->createForm(ModulesType::class, $session);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){  

            $manager->persist($session);
            $manager->flush();
            return $this->redirectToRoute("session_show", ['id' => $session->getId()]);
        }
        
        return $this->render('session/duree.html.twig',[
            'form' => $form->createView(),
            'session' => $session
        ]);

    }

    /** 
    * @Route("/duree/{id}/delete", name="duree_delete")
    */
    public function deleteDuree(Duree $duree, ObjectManager $manager){

        $manager->remove($duree);
        $manager->flush();

        return $this->redirectToRoute("session_index");

    }

/**----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------FORMATEUR---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/



    /**
    * @Route("/addFormateur", name="formateur_add") 
    */
    public function addFormateur(Request $request, ObjectManager $manager){

        $formateur = new Formateur();

        $form = $this->createFormBuilder($formateur)
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('dateNaissance',DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-100, date('Y'))
            ))
            ->add('specialite', EntityType::class, [
                // looks for choices from this entity
                'class' => Categorie::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'intitule',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('codePostal',TextType::class)
            ->add('mail',TextType::class)
            ->add('telephone',TextType::class)
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
     * @Route("formateur/{id}/edit", name="formateur_edit")
     */
    public function editFormateur(Formateur $formateur = null, Request $request, ObjectManager $manager){

        $form = $this->createFormBuilder($formateur)
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('dateNaissance',DateType::class)
            ->add('specialite', EntityType::class, [
                // looks for choices from this entity
                'class' => Categorie::class,
            
                // uses the User.username property as the visible option string
                'choice_label' => 'intitule',
            
                // used to render a select box, check boxes or radios
                // 'multiple' => true,
                // 'expanded' => true,
            ])
            ->add('adresse',TextType::class)
            ->add('ville',TextType::class)
            ->add('codePostal',TextType::class)
            ->add('mail',TextType::class)
            ->add('telephone',TextType::class)
            ->add('Valider',SubmitType::class)
            
            ->getForm();

        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()){

            $manager->flush();
            return $this->redirectToRoute("formateur_show", ['id' => $formateur->getId()]);
        }
        

        return $this->render('formateur/add.html.twig',[
            'form' => $form->createView(),
        ]);
   
    }



    /** 
    * @Route("/formateur/{id}/delete", name="formateur_delete")
    */
    public function deleteFormateur(Formateur $formateur, ObjectManager $manager){

        $manager->remove($formateur);
        $manager->flush();

        return $this->redirectToRoute("formateur_index");

    }


/**----------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------STAGIAIRE---------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------------*/




    /**
    * @Route("/addStagiaire", name="stagiaire_add") 
    */
    public function addStagiaire(Request $request, ObjectManager $manager){

        $stagiaire = new Stagiaire();

        $form = $this->createFormBuilder($stagiaire)
            ->add('prenom',TextType::class)
            ->add('nom',TextType::class)
            ->add('dateNaissance',DateType::class, array(
                'widget' => 'choice',
                'years' => range(date('Y')-100, date('Y'))
            ))
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
     * @Route("/stagiaire/{id}/edit", name="stagiaire_edit")
     */
    public function editStagiaire(Stagiaire $stagiaire = null, Request $request, ObjectManager $manager){

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

            $manager->flush();
            return $this->redirectToRoute("stagiaire_show", ['id' => $stagiaire->getId()]);
        }
        

        return $this->render('stagiaire/add.html.twig',[
            'form' => $form->createView(),
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