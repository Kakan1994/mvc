<?php

namespace App\Controller;

use App\Project\ProjectGame;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjStartTurnController extends AbstractController
{
    /**
     * @Route("/proj/start-turn", name="proj_start_turn")
     */
    public function projStartTurn(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $tableCards = $game->setTurn();

        $game->getAndSetBestHands();

        $session->set('game', $game);
        $session->set('tableCards', $tableCards);

        return $this->redirectToRoute('proj_turn');
    }
}