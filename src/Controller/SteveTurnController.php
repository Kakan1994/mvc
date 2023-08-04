<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\NPCSteve;
use App\Project\PreFlop;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Component\Routing\Annotation\Route;

class SteveTurnController extends AbstractController
{
    /**
     * @Route("/proj/steveturn", name="proj_steve_turn")
     */
    public function projSteveTurn(SessionInterface $session): Response
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

        $playerCards = $playersTurn->getHand()->getCards();
        error_log("Steve's cards: " . $playerCards[0] . " " . $playerCards[1]);
        error_log(var_dump($playersTurn->getHand()));
        
        $type = $playersTurn->getStartingCardType($playerCards);
        error_log("Steve's cards type: " . $type);
        $cards = $playersTurn->getStartingCardValue($playerCards);
        

        $preFlop = new PreFlop();
        $cardsRank = $preFlop->getHandByCardsAndType($cards, $type);
        error_log("Steve's cards rank: " . $cardsRank);


        $riskLevel = $playersTurn->adjustCardRiskRank($cardsRank);

        $highestBet = $game->getHighestBet();
        $blind = $game->getBigBlind();
        $pot = $game->getPot();
        if ($pot == 0) {
            $pot += 1;
        }

        $stage = $game->checkPreOrPostFlop();
        $humanPlayer = $game->getPlayer();
        $riskLevel += $playersTurn->setSteveRisk($humanPlayer, $stage, $pot, $blind);
        $actions = $game->getPossibleActions($playersTurn);

        $methodName = "setSteveAction" . ucfirst($stage);

        $steveAction = $playersTurn->$methodName($riskLevel, $actions);

        $actionData = $playersTurn->setSteveActionAndReturnData($steveAction, $highestBet, $blind);

        if ($actionData[0] === "call" || $actionData[0] === "raise") {
            $game->addToPot($actionData[1]);
        }

        $playersTurn->clearRiskLevel();

        $action = ucfirst($actionData[0]);
        $amount = $actionData[1];

        $game->dequePlayer();
        $game->enquePlayer($playersTurn);

        $session->set('game', $game);

        return $this->redirectToRoute($bRoute);
    }
}