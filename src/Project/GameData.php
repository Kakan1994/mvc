<?php

namespace App\Project;

use App\Cards\CardHand;

class GameData
{
    private array $players = [];

    private string $gameStage = "pre-flop";

    private int $pot;

    private CardHand $tableCards;

    private PlayerInterface $roundWinner;

    private CardHand $winnerHand;

    public function getPlayers(): array
    {
        return $this->players;
    }

    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    public function getGameStage(): string
    {
        return $this->gameStage;
    }

    public function setGameStage(int $numOfTableCards): void
    {
        $stage = "";

        switch ($numOfTableCards) {
            case 3:
                $stage = "flop";
                break;
            case 4:
                $stage = "turn";
                break;
            case 5:
                $stage = "river";
                break;
            default:
                $stage = "pre-flop";
                break;
        }

        $this->gameStage = $stage;
    }

    public function getPot(): int
    {
        return $this->pot;
    }

    public function setPot(int $pot): void
    {
        $this->pot = $pot;
    }

    public function getTableCards(): CardHand
    {
        return $this->tableCards;
    }

    public function setTableCards(CardHand $tableCards): void
    {
        $this->tableCards = $tableCards;
    }

    public function getRoundWinner(): PlayerInterface
    {
        return $this->roundWinner;
    }

    public function setRoundWinner(PlayerInterface $roundWinner): void
    {
        $this->roundWinner = $roundWinner;
    }

    public function getWinnerHand(): CardHand
    {
        return $this->winnerHand;
    }

    public function setWinnerHand(CardHand $winnerHand): void
    {
        $this->winnerHand = $winnerHand;
    }
}