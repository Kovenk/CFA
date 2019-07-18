<?php

namespace App\Controller;
use Dompdf\Dompdf;

// Include Dompdf required namespaces
use Dompdf\Options;
use App\Entity\Session;

use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\DateType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

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


    /**
     * @Route("/12/51/62/3/1/22/1/{id}/{session_id}", name="edit_pdf",  methods="GET")
     * @ParamConverter("session", options={"id" = "session_id"})
     */
    public function editPdfStagiaire(Stagiaire $stagiaire, Session $session)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('stagiaire/titrepropdf.html.twig', [
            'stagiaire' => $stagiaire,
            'session' => $session
        ]);
        
        // Load HTML to Dompdf
        $dompdf->loadHtml($html);
        
        // (Optional) Setup the paper size and orientation 'portrait' or 'landscape'
        $dompdf->setPaper('A4', 'landscape');

        // Render the HTML as PDF
        $dompdf->render();

        // Output the generated PDF to Browser (inline view)
        $dompdf->stream("titrepropdf.pdf", [
            "Attachment" => false
        ]);
    }

}
