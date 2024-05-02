<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class TestController extends AbstractController
{
    #[Route(path: '/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('registration/confirmation_email.html.twig');
    }
}