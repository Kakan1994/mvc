<?php

namespace App\Controller;

use App\Project\ProjectGame;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class ProjectPreFlopController extends AbstractController
{
    /**
     * @Route("/proj/pre-flop", name="proj_pre_flop")
     */
    public function projPreFlop(SessionInterface $session): Response
    {
        $session->set('route-forward', 'proj_start_flop');
        $session->set('route-back', 'proj_pre_flop');

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

            return $this->redirectToRoute('proj_pre_flop');
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
        $raiseAmount = $callAmount + $game->getBigBlind();
        $session->set('game', $game);

        return $this->render('proj/pre_flop.html.twig', [
            'playerQueue' => $playerQueueData,
            'actions' => $possibleActions,
            'call' => $callAmount,
            'raiseAmount' => $raiseAmount,
            'pot' => $pot,
            'callUrl' => $this->generateUrl('proj_player_call'),
            'raiseUrl' => $this->generateUrl('proj_player_raise'),
            'checkUrl' => $this->generateUrl('proj_player_check'),
            'foldUrl' => $this->generateUrl('proj_player_fold')
        ]);
    }



}
