<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ClientController extends AbstractController
{


    //make routes for pages : services , contact , timetable , team
    #[Route('/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('MainPages/client/services.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }
    #[Route(path: '/team', name: 'team')]


    public function team(): Response
    {
        return $this->render('MainPages/client/team.html.twig', ['controller_name' => 'ClientController']);
    }
    #[route('/home', name: 'app_home') ]
    public function home(): Response
    {
        return $this->render('MainPages/client/home.html.twig',['controller_name' => 'ClientController']);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('MainPages/client/contact.html.twig');
    }

    #[Route('/timetable', name: 'app_timetable')]
    public function timetable(): Response
    {
        return $this->render('MainPages/client/timetable.html.twig', [
            'controller_name' => 'TestController',
        ]);
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

    #[Route('/logout', name: 'app_logout')]
    public function logout(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }
}
