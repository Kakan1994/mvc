<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\NPCMatt;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class MattTurnController extends AbstractController
{
    /**
     * @Route("/proj/mattturn", name="proj_matt_turn")
     */
    public function projMattTurn(SessionInterface $session): Response
    {
        $game = $session->get('game');

        if ($game->roundOver()) {
            return $this->redirectToRoute('proj_round_over');
        }
        if ($game->checkNextStage()) {
            return $this->redirectToRoute('proj_change_stage');
        }

        $bRoute = $session->get('route-back');

        $playersTurn = $game->getFirstPlayer();

        if ($playersTurn->getPlayerActions()->hasFolded()) {
            $game->dequePlayer();
            $game->enquePlayer($playersTurn);

            return $this->redirectToRoute($bRoute);
        }

        $actions = $game->getPossibleActions($playersTurn);
        $bet = $game->getHighestBet();
        $blind = $game->getBigBlind();
        error_log("Matt's bet: " . $bet);
        error_log("Matt's blind: " . $blind);
        error_log("Matt's actions: " . $actions);

        $actionData = $playersTurn->setAndReturnMattMove($actions, $bet, $blind);
        error_log("Matt's action: " . $actionData[0] . " " . $actionData[1]);

        if ($actionData[0] === "call" || $actionData[0] === "raise") {
            error_log("Matt's bet: " . $actionData[1]);
            $game->addToPot($actionData[1]);
            
            $playersTurn->addToBets($actionData[1]);
            $playersTurn->decreaseChips($actionData[1]);
        }

        $action = ucfirst($actionData[0]);
        $amount = $actionData[1];

        $game->dequePlayer();
        $game->enquePlayer($playersTurn);

        $session->set('game', $game);

        return $this->redirectToRoute($bRoute);
    }
}
