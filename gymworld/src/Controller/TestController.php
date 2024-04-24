<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    //make routes for pages : services , contact , timetable , team
    #[Route('/services', name: 'app_services')]
    public function services(): Response
    {
        return $this->render('test/services.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('MainPages/contact.html.twig');
    }

    #[Route('/timetable', name: 'app_timetable')]
    public function timetable(): Response
    {
        return $this->render('test/timetable.html.twig', [
            'controller_name' => 'TestController',
        ]);
    }

    #[Route('/team', name: 'app_team')]
    public function team(): Response
    {
        return $this->render('test/team.html.twig', [
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

    #[Route('/admin/dashboard/client', name: 'app_admin_dashboard_client')]
    public function admin_dashboard_client(): Response
    {
         return $this->render('MainPages/Admin/clients.html.twig');
    }

}
