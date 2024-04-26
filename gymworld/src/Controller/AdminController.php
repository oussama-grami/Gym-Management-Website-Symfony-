<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function admin(): Response
    {
        return $this->render('MainPages/admin/index.html.twig');
    }

    #[Route('/admin/dashboard/client', name: 'app_admin_dashboard_client')]
    public function admin_dashboard_client(): Response
    {
        return $this->forward('App\Controller\AdminController::admin_dashboard_client_findAll');
    }

    #[Route('/admin/dashboard/client/findAll/{nbPage<\d+>}/{nbPers<\d+>}', name: 'app_admin_dashboard_client_findAll')]
    public function admin_dashboard_client_findAll(UserRepository $userRepository,
                                                                  $nbPage = 1, $nbPers = 15):
    Response
    {
        $clients = $userRepository->findByExampleField($nbPers, $nbPage);
        $nbTotdePages = ceil($userRepository->count() / $nbPers);
        return $this->render('MainPages/Admin/clients.html.twig', [
            'clients' => $clients,
            'nbTotPages' => $nbTotdePages,
            'nbPageActuelle' => $nbPage,
            'nbPers' => $nbPers
        ]);
    }


    #[Route('/admin/dashboard/client/{id}', name: 'app_admin_dashboard_client_id')]
    public function admin_dashboard_client_id(User $client): Response
    {
        return $this->render('MainPages/Admin/detail_client.html.twig', [
            'client' => $client
        ]);
    }

    #[Route('/admin/dashboard/client/{id}/edit', name: 'app_admin_dashboard_client_id_edit')]
    public function admin_dashboard_client_id_edit($id): Response
    {
        return $this->render('MainPages/Admin/edit_client.html.twig', [
            'client' => ['name' => 'John Doe',
                'email' => '']]);
    }

    #[Route('/admin/dashboard/client/{id}/delete', name: 'app_admin_dashboard_client_id_delete')]
    public function admin_dashboard_client_id_delete(User                   $user = null,
                                                     EntityManagerInterface $registry):
    Response
    {
        if ($user != null) {
            $registry->remove($user);
            $registry->flush();
        }
        return $this->redirectToRoute('app_admin_dashboard_client');
    }


}
