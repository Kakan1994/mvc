<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectGameInitController extends AbstractController
{
    /**
     * @Route("/proj/game-init", name="proj_game_init")
     */
    public function projGameInit(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->setQueAndRoles();
        $game->takeBlinds();
        $game->dealCards();

        $session->set('game', $game);

        return $this->redirectToRoute('proj_pre_flop');
    }
}