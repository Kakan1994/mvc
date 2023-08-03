<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

/**
 * Class Game represents a game of poker.
 */
class ProjectGame
{
    private DeckOfCards $deck;

    private CardHands $cardHands;

    private GameLogic $gameLogic;

    private GameData $gameData;

    private GameQueue $gameQueue;

    private GameState $gameState;

    public function __construct(DeckOfCards $deck, CardHands $cardHands, GameLogic $gameLogic, GameData $gameData, GameQueue $gameQueue, GameState $gameState)
    {
        $this->deck = $deck;
        $this->cardHands = $cardHands;
        $this->gameLogic = $gameLogic;
        $this->gameData = $gameData;
        $this->gameQueue = $gameQueue;
        $this->gameState = $gameState;
    }

    public function setQueAndRoles(): array
    {
        $this->gameQueue->setRolesBeforeStart();

        return $this->gameQueue->getQue();
    }

    public function takeBlinds(): int
    {
        $smallBlind = $this->gameState->getSmallBlind();
        $bigBlind = $this->gameState->getBigBlind();

        $this->gameQueue->getSmallBlindPlayer()->addToBets($smallBlind);
        $this->gameQueue->getSmallBlindPlayer()->decreaseChips($smallBlind);
        $this->gameQueue->getBigBlindPlayer()->addToBets($bigBlind);
        $this->gameQueue->getBigBlindPlayer()->decreaseChips($bigBlind);

        $totPot = $smallBlind + $bigBlind;
        $this->gameState->addToPot($totPot);

        return $this->gameState->getPot();
    }

    public function dealCards(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();
        for ($i = 0; $i < 2; $i++) {
            foreach ($players as $player) {
                $card = $this->deck->draw();
                $player->getHand()->addCard($card[0]);
            }
        }

        return $this->gameQueue->getQue();
    }

    public function getQue(): array
    {
        return $this->gameQueue->getQue();
    }

    public function getPossibleActions(PlayerInterface $player): int
    {
        $players = $this->getQue();

        $playerBet = $player->getBets();

        $highestBet = $this->gameLogic->getHighestBet($players);

        if ($playerBet === $highestBet) {
            return 2;
        }

        return 3;
    }

    public function dequePlayer(): PlayerInterface
    {
        return $this->gameQueue->dequePlayer();
    }

    public function enquePlayer(PlayerInterface $player): PlayerInterface
    {
        $this->gameQueue->enquePlayer($player);

        return $player;
    }

    public function getFirstPlayer(): PlayerInterface
    {
        return $this->gameQueue->peek();
    }

    public function roundOver(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isRoundOver($players);
    }

    public function getHighestBet(): int
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getHighestBet($players);
    }

    public function getPLayerQue(): array
    {
        return $this->gameQueue->getQue();
    }

    public function getPot(): int
    {
        return $this->gameState->getPot();
    }

    public function addToPot(int $amount): int
    {
        $this->gameState->addToPot($amount);

        return $this->gameState->getPot();
    }

    public function getBigBlind(): int
    {
        return $this->gameState->getBigBlind();
    }

    public function getSmallBlind(): int
    {
        return $this->gameState->getSmallBlind();
    }

    public function checkNextStage(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->checkNextStage($players);
    }

    public function setNextStage(): array
    {
        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            $player->getPlayerActions()->resetActions();
        }

        $this->gameQueue->shiftPlayers();

        return $players;
    }

    public function setNewRound(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();

        $winner = $this->gameLogic->getWinner($players);

        $pot = $this->gameState->getPot();

        $winner->addToChips($pot);

        foreach ($players as $player) {
            $player->resetBets();
            $player->getPlayerActions()->resetActions();
            $player->resetHand();
            if ($player->getPlayerActions()->hasFolded()) {
                $player->getPlayerActions()->setHasFolded();
            }
        }

            $this->gameState->resetPot();
            $this->gameState->resetTableCards();

            $this->gameQueue->setQueBeforeStart();

            $this->takeBlinds();
            $this->dealCards();
    

        return [$winner, $pot];
    }

    public function setNewRoundTie(): array
    {
        $this->deck = new DeckOfCards();
        $this->deck->shuffle();

        $players = $this->gameQueue->getQue();

        $winners = $this->getWinnersTie();
        $pot = $this->getPot();

        $count = count($winners);
        $splitPot = $pot / $count;

        foreach ($winners as $winner) {
            $winner->addToChips($splitPot);
        }
        foreach ($players as $player) {
            $player->resetBets();
            $player->getPlayerActions()->resetActions();
            $player->resetHand();
            if ($player->getPlayerActions()->hasFolded()) {
                $player->getPlayerActions()->setHasFolded();
            }
        }
        
            $this->gameState->resetPot();
            $this->gameState->resetTableCards();

            $this->gameQueue->setQueBeforeStart();

            $this->takeBlinds();
            $this->dealCards();
    

        return [$winners, $pot];
    }

    public function getWinner(): PlayerInterface
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getWinner($players);
    }

    public function setFlop(): array
    {
        $card = $this->deck->draw();
        $this->gameState->addTrashCard($card);
        for ($i = 0; $i < 3; $i++) {
            $card = $this->deck->draw();
            $this->gameState->addTableCard($card);
        }

        return $this->getTableCards();
    }

    public function setTurn(): array
    {
        $card = $this->deck->draw();
        $this->gameState->addTrashCard($card);
        $card = $this->deck->draw();
        $this->gameState->addTableCard($card);

        return $this->getTableCards();
    }

    public function setRiver(): array
    {
        $card = $this->deck->draw();
        $this->gameState->addTrashCard($card);
        $card = $this->deck->draw();
        $this->gameState->addTableCard($card);

        return $this->getTableCards();
    }

    public function getTableCards(): array
    {
        return $this->gameState->getTableCardsAsString();
    }

    public function isWinnerByFold(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isWinnerByFold($players);
    }

    public function getAndSetBestHands(): string
    {
        $tableCards = $this->gameState->getTableCards();

        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            if (!$player->getPlayerActions()->hasFolded()) {
                $playerCards = $player->getHand()->getCards();
                $allCards =  new CardHand();
                foreach ($playerCards as $card) {
                    $allCards->addCard($card);
                }
                foreach ($tableCards as $card) {
                    $allCards->addCard($card);
                }
                $bestHand = $this->cardHands->getBestHand($allCards);
                $bestHand = $bestHand*100;
                $highCard = $this->cardHands->checkHighCardAceHigh($allCards);
                $highCardValue = $highCard->getValue();
                $bestHand = $bestHand + $highCardValue;
                $player->setHandValue($bestHand);
            }
        }

        return "done";
    }

    public function checkPreOrPostFlop(): string
    {
        $tableCards = $this->gameState->getTableCards();

        if (empty($tableCards)) {
            return "pre";
        }

        return "post";
    }

    public function getPlayer(): PlayerInterface
    {
        $human = "";

        $players = $this->gameQueue->getQue();

        foreach ($players as $player) {
            if ($player->getName() !== "Matt" && $player->getName() !== "Steve") {
                $human = $player;
            }
        }

        return $human;
    }

    public function isTied(): bool
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->isTied($players);
    }

    public function getWinnersTie(): array
    {
        $players = $this->gameQueue->getQue();

        return $this->gameLogic->getTiedWinners($players);
    }

    public function setGameData(): GameData
    {
        //PLACEHOLDER
    }

    




}
