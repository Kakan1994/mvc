<?php

namespace App\Cards;

class DeckOfCards
{
    /**
     * @var Card[]
     */
    private $cards;
    /**
     * @var string[]
     */
    private $suits = ['♥', '♠', '♦', '♣'];
    /**
     * @var string[]
     */
    private $values = ['A', '2', '3', '4', '5', '6', '7', '8', '9', '10', 'J', 'Q', 'K'];

    public function __construct()
    {
        $this->cards = [];

        foreach ($this->suits as $suit) {
            foreach ($this->values as $value) {
                $this->cards[] = new Card($suit, $value);
            }
        }

        $this->cards[] = new JokerCard();
        $this->cards[] = new JokerCard();
    }

    public function shuffle(): void
    {
        shuffle($this->cards);
    }

    /**
     * @return Card[]
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
     * @return Card[]
     */
    public function getCards(): array
    {
        return $this->cards;
    }
}
