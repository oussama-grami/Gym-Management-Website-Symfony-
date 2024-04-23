<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TestController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): Response
    {
       /* return $this->render('test/index.html.twig');*/
    }
    #[Route('/accesscard',name:'app_accesscard')]
    public function accesscard(): Response
    {
        /*return $this->render('test/accesscard.html.twig');*/
    }
    #[Route('/logout',name:'app_logout')]
    public function logout(): Response
    {
        /*return $this->render('test/logout.html.twig');*/
    }
    #[Route('/services',name:'app_services')]
    public function services(): Response
    {
        /*return $this->render('test/services.html.twig');*/
    }
    #[Route('/team',name:'app_team')]
    public function team(): Response
    {
        /*return $this->render('test/team.html.twig');*/
    }
    #[Route('/contact',name:'app_contact')]
    public function contact(): Response
    {
        /*return $this->render('test/contact.html.twig');*/
    }
    #[Route('/timetable',name:'app_timetable')]
    public function timetable(): Response
    {
        /*return $this->render('test/timetable.html.twig');*/
    }
}
