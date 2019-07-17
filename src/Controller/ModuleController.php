<?php

namespace App\Controller;

use App\Entity\Module;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

/**
 * @Route("/module")
 */
class ModuleController extends AbstractController
{

    /**
     * @Route("/", name="module_index", methods="GET")
     */
    public function indexModule()
    {
        $modules = $this->getDoctrine()
        ->getRepository(Module::class)
        ->getAll();

        return $this->render('module/index.html.twig', [
            'modules' => $modules
        ]);
    }

    
    /**
     * @Route("show/{id}", name="module_show", methods="GET")
     */
    public function showModule(Module $module): Response {
        return $this->render('module/show.html.twig',[
            'module' => $module
        ]);
    }
}
