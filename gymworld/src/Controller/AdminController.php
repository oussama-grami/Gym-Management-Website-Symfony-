<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route(path: '/admin/dashboard/consulterforfait', name: 'consulterforfait')]
    public function consulterforfait():Response
        {
            $offre=new offres();
            $offres=$offre->findAll();
            return $this->render('admin/consulterforfait.html.twig',['offres'=>$offres]);
        }
    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('MainPages/admin/index.html.twig');
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
