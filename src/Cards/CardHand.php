<?php

namespace App\Cards;

/**
 * Class CardHand
 *
 * Represents a hand of cards.
 */
class CardHand
{
    /**
     * @var Card[] $cards   The cards in the hand.
     */
    private $cards;

    /**
     * CardHand constructor.
     */
    public function __construct()
    {
        $this->cards = [];
    }

    /**
     * Add a card to the hand.
     *
     * @param Card $card   The card to add.
     *
     * @return void
     */
    public function addCard(Card $card): void
    {
        $this->cards[] = $card;
    }


    /**
     * Get the cards in the hand.
     *
     * @return Card[] The cards in the hand.
     */
    public function getCards(): array
    {
        return $this->cards;
    }

    /**
     * Get the cards in the hand as an array of strings.
     *
     * @return string[] The cards in the hand as an array of strings.
     */
    public function getCardsAsArray(): array
    {
        $cards = [];

        foreach ($this->cards as $card) {
            $cards[] = $card->getSuit() . $card->getValue();
        }

        return $cards;
    }

    /**
     * Checks if the hand is empty.
     *
     * @return bool True if the hand is empty, false otherwise.
     */
    public function isEmpty(): bool
    {
        return empty($this->cards);
    }
}
