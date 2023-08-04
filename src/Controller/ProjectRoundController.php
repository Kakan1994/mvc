<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectRoundController extends AbstractController
{
    /**
     * @Route("/proj/changestage", name="proj_change_stage")
     */
    public function projChangeStage(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $game->setNextStage();

        $fRoute = $session->get('route-forward');

        $session->set('game', $game);

        return $this->redirectToRoute($fRoute);
    }


    /**
     * @Route("/proj/roundover", name="proj_round_over")
     */
    public function projRoundOver(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $winnerData = $game->setNewRound();

        $player = $winnerData[0]->getName();
        $pot = $winnerData[1];

        $session->set('game', $game);

        return $this->redirectToRoute('proj_pre_flop');
    }

    /**
     * @Route("/proj/tiedroundover", name="proj_tied_round_over")
     */
    public function projTiedRoundOver(SessionInterface $session): Response
    {
        $game = $session->get('game');

        $winnerData = $game->setNewRoundTie();

        $players = $winnerData[0];
        $playerNames = "";

        foreach ($players as $player) {
            $playerNames .= $player->getName() . " ";
        }

        $pot = $winnerData[1];

        $session->set('game', $game);

        return $this->redirectToRoute('proj_pre_flop');
    }
}
