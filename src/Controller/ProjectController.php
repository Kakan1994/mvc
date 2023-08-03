<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Session\SessionInterface;

class ProjectController extends AbstractController
{
    /**
     * @Route("/proj", name="project")
     */
    public function projIndex(): Response
    {
        return $this->render('proj/index.html.twig');
    }

    /**
     * @Route("/proj/buyin", name="proj_buy_in")
     */
    public function projBuyIn(SessionInterface $session): Response
    {
        return $this->render('proj/prep_game.html.twig');
    }

    /**
     * @Route("/proj/clearsession", name="proj_clear_session")
     */
    public function projClearSession(SessionInterface $session): Response
    {
        $session->clear();

        return $this->redirectToRoute('project');
    }

}
