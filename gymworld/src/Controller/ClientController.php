<?php

namespace App\Controller;

use App\Entity\Offres;
use App\Entity\User;
use App\Form\MailerFormType;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Cookie;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function home(): Response
    {
    return $this->render('MainPages/client/home.html.twig');
    }
    //make routes for pages : services , contact , timetable , team
    #[Route('/services', name: 'app_services')]
    public function services(ManagerRegistry $doctrine): Response
    {
        $repository= $doctrine->getRepository(Offres::class);
        $services= $repository->findAll();
        return $this->render('MainPages/client/service.html.twig', [
            'services' => $services
        ]);
    }
    #[Route(path: '/team', name: 'app_team')]
    public function team(): Response
    {
        return $this->render('MainPages/client/team.html.twig', ['controller_name' => 'ClientController']);
    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response{
     $form = $this->createForm(MailerFormType::class);
    $form->handleRequest($request);

    if ($form->isSubmitted() && $form->isValid()) {
        $data = $form->getData();

        $email = (new Email())
            ->to('gymworld135@gmail.com')
            ->from('gymworld135@gmail.com')
            ->subject($data['subject'])
            ->text($data['from']." ".$data['message']);
            $mailer->send($email);

        $this->addFlash('success', 'Email sent successfully!');
        // Redirect or render a success page
    }

return $this->render('MainPages/client/contact.html.twig', [
    'form' => $form->createView(),
]); }

    #[Route('/timetable', name: 'app_timetable')]
    public function timetable(): Response
    {
        return $this->render('MainPages/client/timetable.html.twig', [
            'controller_name' => 'TestController',
    #[Route('/timetable/{num<\d+>?1}', name: 'app_timetable')]
    public function timetable($num ,Request $request): Response
    {

        $response =$this->render('MainPages/client/timetable.html.twig',[
            'num'=>$num
        ]);
        $response->headers->set('Cache-Control', 'max-age=1, must-revalidate');
        $response->headers->set('Pragma', 'no-cache'); // Pour HTTP 1.0
        $response->headers->set('Expires', '0'); // Pour les proxies
        return $response;
    }



    #[Route('/user/dashboard', name: 'app_user_dashboard')]
    public function dashboard(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }

    #[Route('/user/accesscard', name: 'app_user_accesscard')]
    public function accesscard(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }

   
   
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        #return $this->render('MainPages/client/login.html.twig');

    }
    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {


        return $this->render('MainPages/client/signup.html.twig');

    }
    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }
   }
