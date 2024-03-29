<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\PreFlop;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjTurnController extends AbstractController
{
    /**
     * @Route("/proj/turn", name="proj_turn")
     */
    public function projTurn(SessionInterface $session): Response
    {
        $session->set('route-forward', 'proj_start_river');
        $session->set('route-back', 'proj_turn');

        $game = $session->get('game');

        if ($game->roundOver()) {
            return $this->redirectToRoute('proj_round_over');
        }

        if ($game->checkNextStage()) {
            return $this->redirectToRoute('proj_change_stage');
        }

        $playerQueue = $game->getQue();

        $playersTurn = $game->getFirstPlayer();

        if ($playersTurn->getPlayerActions()->hasFolded()) {
            $game->dequePlayer();
            $game->enquePlayer($playersTurn);

            return $this->redirectToRoute('proj_turn');
        }

        if ($playersTurn->getName() == "Matt") {
            return $this->redirectToRoute('proj_matt_turn');
        }

        if ($playersTurn->getName() == "Steve") {
            return $this->redirectToRoute('proj_steve_turn');
        }

        $playerQueueData = [];

        foreach ($playerQueue as $player) {
            $playerQueueData[] = $player->getPlayerData();
        }

        $player = $game->getFirstPlayer();

        $possibleActions = $game->getPossibleActions($player);

        $highestBet = $game->getHighestBet();
        $pot = $game->getPot();

        $callAmount = $highestBet - $player->getBets();
        $raiseAmount = $game->getBigBlind();

        $session->set('game', $game);
        $tableCards = $session->get('tableCards');

        return $this->render('proj/post_flop.html.twig', [
            'playerQueue' => $playerQueueData,
            'actions' => $possibleActions,
            'call' => $callAmount,
            'raiseAmount' => $raiseAmount,
            'pot' => $pot,
            'tableCards' => $tableCards,
            'callUrl' => $this->generateUrl('proj_player_call'),
            'raiseUrl' => $this->generateUrl('proj_player_raise'),
            'checkUrl' => $this->generateUrl('proj_player_check'),
            'foldUrl' => $this->generateUrl('proj_player_fold')
        ]);
    }
}
