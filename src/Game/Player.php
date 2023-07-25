<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

/**
 * Class Player
 *
 * Represents a player in the game.
 */
class Player
{
    /**
     * @var string $name The name of the player.
     */
    protected $name;

    /**
     * @var CardHand $hand The hand of the player.
     */
    protected $hand;

    /**
     * @var int $score The score of the players current hand.
     */
    protected $score;

    /**
     * Player constructor.
     *
     * @param string $name The name of the player.
     */
    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
        $this->score = 0;
    }

    /**
     * Draw a card from the deck and add it to the players hand.
     *
     * @param DeckOfCards $deck The deck to draw from.
     */
    public function drawCard(DeckOfCards $deck): void
    {
        $this->hand->addCard($deck->draw()[0]);
    }

    /**
     * Get the players hand.
     *
     * @return CardHand The players hand.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Get the name of the player.
     *
     * @return string The name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the score of the players current hand.
     *
     * @return int The score of the players current hand.
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Add a score to the players current score.
     *
     * @param int $score The score to add.
     */
    public function addScore(int $score): void
    {
        $this->score += $score;
    }

    /**
     * Clear the players hand by creating a new empty hand.
     */
    public function clearHand(): void
    {
        $this->hand = new CardHand();
    }
}
