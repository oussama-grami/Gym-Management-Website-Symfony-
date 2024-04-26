<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Symfony\Bridge\Doctrine\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class TestController extends AbstractController
{
    #[Route('/{id}', name: 'app_home')]
    public function index(User $user=null,UserRepository $repository): Response
    {
        dd($repository->findAll());
        return $this->render('test/index.html.twig');
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
    #[route('/home', name: 'app_home') ]
    public function home(): Response
    {
        return $this->render('MainPages/home.html.twig',['controller_name' => 'TestController']);
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
        return $this->render('MainPages/Admin/clients.html.twig', [
            'clients' => [
                0 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                1 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                2 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1]
                , 3 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                4 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                5 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                6 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1]
                , 7 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1],
                8 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1], 9 => ['name' => 'John Doe',
                    'email' => 'test@gmail.com',
                    'id' => 1]

            ]
        ]);
    }

    #[Route('/admin/dashboard/client/{id}', name: 'app_admin_dashboard_client_id')]
    public function admin_dashboard_client_id($id): Response
    {
        return $this->render('MainPages/Admin/detail_client.html.twig', [
            'client' => ['name' => 'John Doe',
                'email' => 'test@gmail.com', 'id' => $id, 'telephone' => '123456789',
                'address' => '1234 rue de paris',
                'subscriptions' => [
                    'name' => 'subscription 1',
                    'date-fin' => '2021-12-12',
                ]
            ]]);
    }

    #[Route('/admin/dashboard/client/{id}/edit', name: 'app_admin_dashboard_client_id_edit')]
    public function admin_dashboard_client_id_edit($id): Response
    {
        return $this->render('MainPages/Admin/edit_client.html.twig', [
            'client' => ['name' => 'John Doe',
                'email' => '']]);
    }

    #[Route('/admin/dashboard/client/{id}/delete', name: 'app_admin_dashboard_client_id_delete')]
    public function admin_dashboard_client_id_delete($id): Response
    {
        return $this->render('MainPages/Admin/delete_client.html.twig', [
            'client' => ['name' => 'John Doe',
                'email' => '']]);
    }
}
