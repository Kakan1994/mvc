<?php

namespace App\Controller;

use App\Project\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjStartEndTurnController extends AbstractController
{
    /**
     * @Route("/proj/start-end-turn", name="proj_start_end_turn")
     */
    public function projStartEndTurn(SessionInterface $session): Response
    {
        $game = $session->get('game');

        if ($game->isTied()) {
            return $this->redirectToRoute('proj_tie');
        }

        return $this->redirectToRoute('proj_end_turn');
    }
}
