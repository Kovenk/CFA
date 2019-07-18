<?php

namespace App\Controller;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;

// Include Dompdf required namespaces
use Dompdf\Dompdf;
use Dompdf\Options;

use App\Entity\Stagiaire;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\DateType;

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
     * @Route("/editPdf/{id}", name="edit_pdf",  methods="GET")
     */
    public function editPdfStagiaire(Stagiaire $stagiaire)
    {
        // Configure Dompdf according to your needs
        $pdfOptions = new Options();
        $pdfOptions->set('defaultFont', 'Arial');
        
        // Instantiate Dompdf with our options
        $dompdf = new Dompdf($pdfOptions);
        
        // Retrieve the HTML generated in our twig file
        $html = $this->renderView('stagiaire/titrepropdf.html.twig', [
            'stagiaire' => $stagiaire
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
