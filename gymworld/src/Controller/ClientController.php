<?php

namespace App\Controller;

use App\Entity\Offres;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\Persistence\ManagerRegistry;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

/*#[IsGranted('ROLE_USER')]*/
class ClientController extends AbstractController
{
    #[Route('/home', name: 'app_home')]
    public function index(): Response
    {
    return $this->render('MainPages/client/home.html.twig');
    }
    //make routes for pages : services , contact , timetable , team
    #[Route('/services', name: 'app_services')]
    public function services(ManagerRegistry $doctrine): Response
    {
        $repository = $doctrine->getRepository(Offres::class);
        $services = $repository->findAll();
        return $this->render('MainPages/client/service.html.twig', [
            'services' => $services
        ]);
    }
    #[Route(path: '/team', name: 'app_team')]
    public function team(): Response
    {
        return $this->render('MainPages/client/team.html.twig', ['controller_name' => 'ClientController']);
    }

    #[route('/', name: 'app_home')]
    public function home(): Response
    {
        return $this->render('MainPages/client/home.html.twig', ['controller_name' => 'ClientController']);
    }

    #[Route('/contact', name: 'app_contact')]
    public function contact(): Response
    {
        return $this->render('MainPages/client/contact.html.twig');
    }

    #[Route('/timetable/{num<\d+>?1}', name: 'app_timetable')]
    public function timetable($num): Response
    {
        return $this->render('MainPages/client/timetable.html.twig', [
            'num' => $num
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
    #[Route('/logout', name: 'app_login')]
    public function login(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }
    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        /* return $this->render('test/about.html.twig', [
             'controller_name' => 'TestController',
         ]);*/
    }
}
