<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;


/**
 * @Route("/", name="home")
 */
class HomeController extends AbstractController
{
    /**
     * @Route("/guide", name="_guide")
     */
    public function guide(): Response
    {
        return $this->render('home/guide.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }

    /**
     * @Route("/", name="_index")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'HomeController',
        ]);
    }
}
