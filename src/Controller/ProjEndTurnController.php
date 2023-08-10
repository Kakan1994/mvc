<?php

namespace App\Controller;

use App\Project\ProjectGame;
use App\Project\PreFlop;
use App\Cards\CardHand;
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
        $session->set('route-forward', 'proj_round_over');
        $session->set('route-back', 'proj_end_turn');

        $game = $session->get('game');

        $playerQueue = $game->getQue();

        $playerQueueData = [];

        foreach ($playerQueue as $player) {
            $allCards = new cardHand();

            $playerCards = $player->getHand()->getCards();
            if (!empty($playerCards)) {
                foreach ($playerCards as $card) {
                    $allCards->addCard($card);
                }
            }
            $tableCards = $game->getGameState()->getTableCards()->getCards();

            if (!empty($tableCards)) {
                foreach ($tableCards as $card) {
                    $allCards->addCard($card);
                }
            }
            $player->setBest5CardHand($allCards);
            $player->setBest5CardHandArray();

            $playerQueueData[] = $player->getPlayerData();
        }

        $pot = $game->getPot();
        $winner = $game->getWinner();

        $winnerName = $winner->getName();
        $winnerHand = $winner->getBestHandName();
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

    /**
     * @Route("/proj/tie", name="proj_tie")
     */
    public function projTie(SessionInterface $session): Response
    {
        $session->set('route-forward', 'proj_tied_round_over');
        $session->set('route-back', 'proj_tie');

        $game = $session->get('game');

        $playerQueue = $game->getQue();

        $playerQueueData = [];

        foreach ($playerQueue as $player) {
            $allCards = new cardHand();

            $playerCards = $player->getHand()->getCards();
            if (!empty($playerCards)) {
                foreach ($playerCards as $card) {
                    $allCards->addCard($card);
                }
            }
            $tableCards = $game->getGameState()->getTableCards()->getCards();

            if (!empty($tableCards)) {
                foreach ($tableCards as $card) {
                    $allCards->addCard($card);
                }
            }
            $player->setBest5CardHand($allCards);
            $player->setBest5CardHandArray();

            $playerQueueData[] = $player->getPlayerData();
        }

        $pot = $game->getPot();

        $winners = $game->getWinnersTie();

        $bestHand = $winners[0]->getBestHandName();

        $winnerNames = "";

        foreach ($winners as $winner) {
            $winnerNames .= $winner->getName() . ", ";
        }

        $session->set('game', $game);
        $tableCards = $session->get('tableCards');

        return $this->render('proj/winner_tie.html.twig', [
            'playerQueue' => $playerQueueData,
            'pot' => $pot,
            'tableCards' => $tableCards,
            'restartUrl' => $this->generateUrl('proj_change_stage'),
            'winner' => $winnerNames,
            'bestHand' => $bestHand,
        ]);





    }
}
