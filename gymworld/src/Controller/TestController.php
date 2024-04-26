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
    #[Route('/', name: 'app_home')]
    public function test(): Response
    {
        /*return $this->render('MainPages/test/index.html.twig', [
            'controller_name' => 'TestController',
        ]);*/
    }

}