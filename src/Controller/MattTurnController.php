<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\NPCMatt;
use App\Cards\CardHand;
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

        $actionData = $playersTurn->setAndReturnMattMove($actions, $bet, $blind);

        if ($actionData[0] === "call" || $actionData[0] === "raise") {
            $game->addToPot($actionData[1]);

            $playersTurn->addToBets($actionData[1]);
            $playersTurn->decreaseChips($actionData[1]);
        }

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

        $game->dequePlayer();
        $game->enquePlayer($playersTurn);

        $session->set('game', $game);

        return $this->redirectToRoute($bRoute);
    }
}
