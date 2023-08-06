<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\PreFlop;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjEndTurnController extends AbstractController
{
    /**
     * @Route("/proj/endturn", name="proj_end_turn")
     */
    public function projEndTurn(SessionInterface $session): Response
    {
        $session->set('route-forward', 'proj_change_stage');
        $session->set('route-back', 'proj_end_turn');

        $game = $session->get('game');

        $playerQueue = $game->getPLayerQue();

        $playerQueueData = [];
        $allBets = 0;

        foreach ($playerQueue as $player) {
            $playerQueueData[] = $player->getPlayerData();
            error_log(var_dump("player"));
            error_log(var_dump($player));
            $allBets += $player->getBets();
        }

        $pot = $game->getPot();
        $winner = $game->getWinner();
        error_log("winner");
        error_log(var_dump($winner));

        $winnerName = $winner->getName();
        $winnerHand = $winner->getBestHandName();
        error_log("winnerHand");
        error_log($winnerHand);
        $winnerCards = $winner->getBest5CardHandArray();

        $gameData = $game->setGameData();

        $gameData->setRoundWinner($winner);
        $gameData->setWinnerHand($winner->getBest5CardHandArray());

        $session->set('game', $game);
        $tableCards = $session->get('tableCards');

        return $this->render('proj/winner.html.twig', [
            'playerQueue' => $playerQueueData,
            'pot' => $pot,
            'tableCards' => $tableCards,
            'restartUrl' => $this->generateUrl('proj_change_stage'),
            'winner' => $winnerName,
            'winnerHand' => $winnerHand,
            'winnerCards' => $winnerCards,
        ]);
    }
}
