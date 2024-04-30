<?php

namespace App\Controller;

use App\Entity\Offres;
use App\Entity\User;
use App\Form\UserType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Client\Request;
use phpDocumentor\Reflection\Types\False_;
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

    #[Route('/admin/dashboard/clients', name: 'app_admin_dashboard_client')]
    public function admin_dashboard_client(): Response
    {


        return $this->forward('App\Controller\AdminController::admin_dashboard_client_findAll');
    }

    #[Route('/admin/dashboard/client/findAll/{nbPers<\d+>}/{nbPage<\d+>}', name: 'app_admin_dashboard_client_findAll')]
    public function admin_dashboard_client_findAll(UserRepository $userRepository,
                                                                  $nbPers = 15, $nbPage =
                                                   1):
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
    #[Route('/admin/dashboard/add',name: 'app_admin_dashboard_add')]
    public function admin_dashboard_add(ManagerRegistry $doctrine,\Symfony\Component\HttpFoundation\Request $request):Response
    {

        $user=new User();
        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        try {
            if ($form->isSubmitted()) {
                $manager = $doctrine->getManager();
                $manager->persist($user);
                $manager->flush();
                $this->addFlash('success', $user->getName() . "a ete ajoute avec succes");
                return $this->redirectToRoute('app_admin_dashboard_client_findAll');
            } else {
                return $this->render('MainPages/Admin/add_or_edit_client.html.twig', ['form' => $form->createView()]);
            }
        }catch (\Exception $e){
            $this->addFlash('error', "Une erreur s'est produite , veuillez reessayez .");
            return $this->redirectToRoute('app_admin_dashboard_client_findAll');
        }

    }
    #[Route('/admin/dashboard/edit/{id?0}',name: 'app_admin_dashboard_edit')]
    public function admin_dashboard_edit(User $user=null,ManagerRegistry $doctrine,\Symfony\Component\HttpFoundation\Request $request):Response
    {
        $new=false;
        if(
            !$user
        )
        {
            $new=true;
            $user=new User();
        }


        $form=$this->createForm(UserType::class,$user);
        $form->handleRequest($request);
        if($form->isSubmitted() ){
            $manager=$doctrine->getManager();
            $manager->persist($user);
            $manager->flush();

            if($new)
            {
                $msg="a ete ajoute avec succes";
            }
            else{
                $msg="a ete edite avec succes";
            }
            $this->addFlash('success',$user->getName().$msg);
            return  $this->redirectToRoute('app_admin_dashboard_client_findAll');
        }else{
            return $this->render('MainPages/Admin/add_or_edit_client.html.twig',['form'=>$form->createView()]);
        }


    }
    #[Route('/admin/dashboard/client/{id}', name: 'app_admin_dashboard_client_id')]
    public function admin_dashboard_client_id($id, User $client = null): Response
    {
        if ($client == null) {
            $this->addFlash('error', 'Client avec l\'id ' . $id . ' non trouvé');
            return $this->redirectToRoute('app_admin_dashboard_client');
        }
        $this->addFlash('success', 'Client avec l\'id ' . $id . ' trouvé avec succes');
        return $this->render('MainPages/Admin/detail_client.html.twig', [
            'client' => $client,
            'dateActuelle' => new \DateTime()
        ]);
    }

    #[Route('/admin/dashboard/client/{id?0}/edit', name: 'app_admin_dashboard_client_id_edit')]
    public function admin_dashboard_client_id_edit($id, User $client = null): Response
    {
        if ($client == null && $id != 0) {
            $this->addFlash('error', 'Client avec l\'id ' . $id . ' non trouvé');
            return $this->redirectToRoute('app_admin_dashboard_client');
        }
        return $this->render('MainPages/Admin/add_or_edit_client.html.twig', [
            'client' => ['name' => 'John Doe',
                'email' => '']]);
    }

    #[Route('/admin/dashboard/client/{id}/delete', name: 'app_admin_dashboard_client_id_delete')]
    public function admin_dashboard_client_id_delete($id,
                                                     EntityManagerInterface $registry, User $user = null): Response
    {
        if ($user != null) {
            $registry->remove($user);
            $registry->flush();
            $this->addFlash('success', 'Client avec l\'id ' . $id . ' supprimé avec succès');
        } else {
            $this->addFlash('error', 'Client avec l\'id ' . $id . ' non trouvé');
        }
        return $this->redirectToRoute('app_admin_dashboard_client');
    }


}
