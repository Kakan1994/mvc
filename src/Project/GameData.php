<?php

namespace App\Project;

use App\Cards\CardHand;

/**
 * Class GameData
 * 
 * This class is used to store the game data.
 */
class GameData
{
    /**
     * @var array $players The players in the game.
     */
    private array $players = [];

    /**
     * @var string $gameStage The stage of the game.
     */
    private string $gameStage = "pre-flop";

    /**
     * @var int $pot The pot.
     */
    private int $pot;

    /**
     * @var array $tableCards The cards on the table.
     */
    private array $tableCards;

    /**
     * @var PlayerInterface $roundWinner The winner of the round.
     */
    private PlayerInterface $roundWinner;

    /**
     * @var array $winnerHand The winning hand.
     */
    private array $winnerHand;

    /**
     * Get the players.
     * 
     * @return array The players.
     */
    public function getPlayers(): array
    {
        return $this->players;
    }

    /**
     * Set the players.
     * 
     * @param array $players The players.
     * 
     * @return void
     */
    public function setPlayers(array $players): void
    {
        $this->players = $players;
    }

    /**
     * Get the game stage.
     * 
     * @return string The game stage.
     */
    public function getGameStage(): string
    {
        return $this->gameStage;
    }

    /**
     * Set the game stage.
     * 
     * @param int $numOfTableCards The number of cards on the table.
     * 
     * @return void
     */
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

    /**
     * Get the pot.
     * 
     * @return int The pot.
     */
    public function getPot(): int
    {
        return $this->pot;
    }

    /**
     * Set the pot.
     * 
     * @param int $pot The pot.
     * 
     * @return void
     */
    public function setPot(int $pot): void
    {
        $this->pot = $pot;
    }

    /**
     * Get the cards on the table.
     * 
     * @return array The cards on the table.
     */
    public function getTableCards(): array
    {
        return $this->tableCards;
    }

    /**
     * Set the cards on the table.
     * 
     * @param array $tableCards The cards on the table.
     * 
     * @return void
     */
    public function setTableCards(array $tableCards): void
    {
        $this->tableCards = $tableCards;
    }

    /**
     * Get the winner of the round.
     * 
     * @return PlayerInterface The winner of the round.
     */
    public function getRoundWinner(): PlayerInterface
    {
        return $this->roundWinner;
    }

    /**
     * Set the winner of the round.
     * 
     * @param PlayerInterface $roundWinner The winner of the round.
     * 
     * @return void
     */
    public function setRoundWinner(PlayerInterface $roundWinner): void
    {
        $this->roundWinner = $roundWinner;
    }

    /**
     * Get the winning hand.
     * 
     * @return array The winning hand.
     */
    public function getWinnerHand(): array
    {
        return $this->winnerHand;
    }

    /**
     * Set the winning hand.
     * 
     * @param array $winnerHand The winning hand.
     * 
     * @return void
     */
    public function setWinnerHand(array $winnerHand): void
    {
        $this->winnerHand = $winnerHand;
    }
}