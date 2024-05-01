<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OffreClientRepository;
use App\Repository\UserRepository;
use App\services\PdfService;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class PublicController extends AbstractController
{
    public function __construct(private PdfService $pdfService ){

    }
    #[Route('/admin/login', name: 'app_admin_login')]
    public function adminlogin(): Response
    {
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }

    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        return $this->render('public/index.html.twig', [
            'controller_name' => 'PublicController',
        ]);
    }
    #[Route('/accessCard/{id}', name:  'app_access_card' )]
    public function accessCard(User $personne=null ,PdfService $pdfService): Response
    {
        if($personne==null){
            return $this->redirectToRoute('app_home');
        }else{
            $offres =$personne->getOffreClients();

            if(count($offres)==0){
                return $this->redirectToRoute('app_home');
            }else{
                $html = $this->renderView('public/pdf.html.twig', ['personne' => $personne]); // Utilise renderView() pour générer le HTML sans le rendre
                $pdfContent = $pdfService->generatePdfContent($html);
                $response = new Response($pdfContent);
                $response->headers->set('Content-Type', 'application/pdf');
                $response->headers->set('Content-Disposition', 'attachment; filename="details.pdf"');
                return $response;

        }

        }



    }


}
