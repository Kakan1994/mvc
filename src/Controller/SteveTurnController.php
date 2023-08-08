<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\NPCSteve;
use App\Project\PreFlop;
use App\Cards\CardHand;
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
        
        $type = $playersTurn->getStartingCardType($playerCards);
        $cards = $playersTurn->getStartingCardValue($playerCards);
        

        $preFlop = new PreFlop();
        $cardsRank = $preFlop->getHandByCardsAndType($cards, $type);


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

        $allCards = new cardHand();

        $playerCards = $playersTurn->getHand()->getCards();

        if (!empty($playerCards)) {
            foreach ($playerCards as $card) {
                // error_log("card: " . $card);
                $allCards->addCard($card);
            }
        }

        $tableCards = $game->getGameState()->getTableCards()->getCards();

        if (!empty($tableCards)) {
            foreach ($tableCards as $card) {
                $allCards->addCard($card);
            }
        }

        $playersTurn->setBest5CardHand($allCards);
        $playersTurn->setBest5CardHandArray();

        // error_log("Steve's best hand: ");
        // foreach ($playersTurn->getBest5CardHandArray() as $card) {
        //     error_log($card);
        // }
        // error_log("Steve's best hand name: " . $playersTurn->getBestHandName());

        $game->dequePlayer();
        $game->enquePlayer($playersTurn);

        $session->set('game', $game);

        return $this->redirectToRoute($bRoute);
    }
}
