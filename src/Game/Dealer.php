<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;

/**
 * Class Dealer
 *
 * Represents the dealer in the game.
 */
class Dealer extends Player
{
    /**
     * @var Card[] $hiddenCard The dealers hidden card.
     */
    private $hiddenCard;

    /**
     * @var bool $hiddenCardRevealed Whether the hidden card has been revealed.
     */
    protected $hiddenCardRevealed;

    /**
     * Dealer constructor.
     */
    public function __construct()
    {
        parent::__construct('Dealer');
        $this->hiddenCard = [];
    }

    /**
     * Draw a hidden card from the deck.
     *
     * @param DeckOfCards $deck The deck to draw from.
     */
    public function drawHiddenCard(DeckOfCards $deck): void
    {
        $this->hiddenCard = $deck->draw();
        $this->hiddenCardRevealed = false;
    }

    /**
     * Get the dealers hand.
     *
     * @return CardHand The dealers hand without the hidden card.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Get the dealers name.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Get the dealers score.
     */
    public function getScore(): int
    {
        return $this->score;
    }

    /**
     * Add to the dealers score.
     *
     * @param int $score The score to add.
     */
    public function addScore(int $score): void
    {
        $this->score += $score;
    }

    /**
     * Reveal the hidden card.
     */
    public function revealHiddenCard(): void
    {
        // error_log(print_r($this->hiddenCard, true));
        $this->hand->addCard($this->hiddenCard[0]);
        $this->hiddenCardRevealed = true;
        $this->hiddenCard = [];
    }

    /**
     * Check if the hidden card has been revealed.
     *
     * @return bool Whether the hidden card has been revealed.
     */
    public function isHiddenCardRevealed(): bool
    {
        if ($this->hiddenCardRevealed) {
            return true;
        }
        return false;
    }
}
