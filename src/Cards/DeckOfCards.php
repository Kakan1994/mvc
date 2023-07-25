<?php

namespace App\Cards;

/**
 * Class DeckOfCards
 *
 * Represents a deck of cards.
 */
class DeckOfCards
{
    /**
     * @var Card[] $cards   The cards in the deck.
     */
    private $cards;
    /**
     * @var string[] $suits   The suits of the cards.
     */
    private $suits = ['♥', '♠', '♦', '♣'];
    /**
     * @var string[] $values   The values of the cards.
     */
    private $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    /**
     * DeckOfCards constructor.
     */
    public function __construct()
    {
        $this->cards = [];

        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }
    }

    /**
     * Shuffle the deck.
     *
     * @return void
     */
    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    /**
     * Draw a card from the deck.
     *
     * @param int $count   The number of cards to draw.
     *
     * @return Card[] The drawn cards.
     */
    public function draw(int $count = 1): array
    {
        $drawnCards = [];

        for ($i = 0; $i < $count && !empty($this->cards); $i++) {
            $drawnCards[] = array_pop($this->cards);
        }

        return $drawnCards;
    }

    /**
     * Get the cards in the deck.
     *
     * @return Card[] The cards in the deck.
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}
