<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{
    /**
     * @Route("/", name="home")
     */
    public function index(): Response
    {
        return $this->render('home/index.html.twig');
    }

    /**
     * @Route("/about", name="about")
     */
    public function about(): Response
    {
        return $this->render('home/about.html.twig');
    }

    /**
     * @Route("/report", name="report")
     */
    public function report(): Response
    {
        return $this->render('home/report.html.twig');
    }

    /**
     * @Route("/lucky", name="lucky")
     */
    public function lucky(): Response
    {
        $luckyNumber = mt_rand(1, 100);
        return $this->render('home/lucky.html.twig', [
            'lucky_number' => $luckyNumber,
        ]);
    }

    /**
     * @Route("/metrics", name="metrics")
     */
    public function metrics(): Response
    {
        return $this->render('home/metrics.html.twig');
    }
}
