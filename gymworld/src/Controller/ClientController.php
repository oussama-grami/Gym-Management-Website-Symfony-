<?php

namespace App\Controller;

use App\Entity\OffreClient;
use App\Entity\Offres;
use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

/*#[IsGranted('ROLE_USER')]*/
class ClientController extends AbstractController
{



    #[Route('/success', name: 'success')]
    public function success(): Response
    {
        return $this->render('MainPages/client/paysuccess.html.twig');
    }
    #[Route(path: '/payment', name: 'app_pay')]
    public function pay(SessionInterface $session,EntityManagerInterface $manager): Response
    {
        $offreID = $session->get('offreID');
        $offreDuration = $session->get('offreDuration');
        if (!$this->getUser()) {
          return new RedirectResponse($this->generateUrl('app_login'));
        }

        $stripe_secret_key = 'sk_test_51OyjfCLP09EeDvhaQKed2zemxoS5nkUOnsy22lqz52tXfxWCrs7sUIMxDGLIyWyoqCXY9vfjkS44Yhkqb0eeBCNq00ksDn2Xnc';
        \Stripe\Stripe::setApiKey($stripe_secret_key);

        try {
            $checkout_session = \Stripe\Checkout\Session::create([
                "mode" => "payment",
                "success_url" => $this->generateUrl('success', [], UrlGeneratorInterface::ABSOLUTE_URL),
                "line_items" => [
                    [
                        "quantity" => 1,
                        "price_data" => [
                            "currency" => "usd",
                            "unit_amount" => $_POST['price'],
                            "product_data" => [
                                "name" => $_POST['offre']
                            ]
                        ]
                    ]
                ]
            ]);
            $offreclient=new OffreClient();
            $offre=$manager->getRepository(Offres::class)->find($offreID);
            $client=$manager->getRepository(User::class)->find($this->getUser()->getId());
            $offreclient->setClient($client);
            $offreclient->setOffre($offre);
            $date=new \DateTime();
            $offreclient->setDateDebut($date);
            $offreclient->setDateFin($date+$offreDuration);
            $manager->persist($offreclient);
            $manager->flush();

            return new RedirectResponse($checkout_session->url, 303);
        } catch (\Stripe\Exception\ApiErrorException $e) {

            return new RedirectResponse($this->generateUrl('error', [], UrlGeneratorInterface::ABSOLUTE_URL));
        }


    }
    #[Route(path: '/error', name: 'error')]
    public function error(): Response
    {
        return $this->render('MainPages/client/error.html.twig');
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
    #[Route('/login', name: 'app_login')]
    public function login(): Response
    {
        #return $this->render('MainPages/client/login.html.twig');
    }
    #[Route('/signup', name: 'app_signup')]
    public function signup(): Response
    {
        return $this->render('MainPages/client/signup.html.twig');

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
