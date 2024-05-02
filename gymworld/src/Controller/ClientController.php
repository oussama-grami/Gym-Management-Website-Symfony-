<?php

namespace App\Controller;

use App\Entity\OffreClient;
use App\Entity\Offres;
use App\Entity\User;
use App\Form\MailerFormType;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use http\Client;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

use Symfony\Component\HttpFoundation\Cookie;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

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
    public function pay(Request $request, EntityManagerInterface $manager): Response
    {
        $offreID = $request->request->get('offreID');
        $offrename = $request->request->get('offre');
        $offreDuration = $request->request->get('offreDuration');
        $price = $request->request->get('price');
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
                        "price_data" => [
                            "currency" => "usd",
                            "unit_amount" => $price * 100,
                            "product_data" => [
                                "name" => $offrename,
                            ],
                        ],
                        "quantity" => 1,
                    ],
                ],
            ]);

            $offreclient = new OffreClient();
            $offre = $manager->getRepository(Offres::class)->find($offreID);
            $client = $manager->getRepository(User::class)->find($this->getUser()->getId());
            $offreclient->setClient($client);
            $offreclient->setOffre($offre);
            $date = new \DateTime();
            $offreclient->setDateDebut($date);
            $offreclient->setDateFin($date->add(new \DateInterval('P'.$offreDuration.'D')));
            $manager->persist($offreclient);
            $manager->flush();

            return new RedirectResponse($checkout_session->url, 303);
        } catch (\Stripe\Exception\ApiErrorException $e) {
            error_log('offreID: ' . $offreID);
            error_log('offre: ' . $offrename);
            error_log('offreDuration: ' . $offreDuration);
            error_log('price: ' . $price);
            error_log($e->getMessage());
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

    #[Route('/', name: 'app_home') ]
    public function home(): Response
    {
        return $this->render('MainPages/client/index.html.twig', ['controller_name' => 'ClientController']);

    }


    #[Route('/contact', name: 'app_contact')]
    public function contact(Request $request, MailerInterface $mailer): Response{
        $form = $this->createForm(MailerFormType::class);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $data = $form->getData();

            $email = (new Email())
                ->to('gymworld135@gmail.com')
                ->from('gymworld135@gmail.com')
                ->subject($data['subject'])
                ->text($data['from']." ".$data['message']);
            $mailer->send($email);

            $this->addFlash('success', 'Email sent successfully!');
            // Redirect or render a success page
        }

        return $this->render('MainPages/client/contact.html.twig', [
            'form' => $form->createView(),
        ]); }

    #[Route('/timetable/{num<\d+>?1}', name: 'app_timetable')]
    public function timetable($num ,Request $request): Response
    {

        $response =$this->render('MainPages/client/timetable.html.twig',[
            'num'=>$num
        ]);
        $response->headers->set('Cache-Control', 'max-age=1, must-revalidate');
        $response->headers->set('Pragma', 'no-cache'); // Pour HTTP 1.0
        $response->headers->set('Expires', '0'); // Pour les proxies
        return $response;
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




}
