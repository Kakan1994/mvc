<?php

namespace App\Cards;

class DeckOfCards
{
    private $cards;
    private $suits = ['♠', '♣', '♦', '♥'];
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

    public function shuffle()
    {
        shuffle($this->cards);
    }

    public function draw($count = 1)
    {
        $drawnCards = [];

        for ($i = 0; $i < $count && !empty($this->cards); $i++) {
            $drawnCards[] = array_pop($this->cards);
        }

        return $drawnCards;
    }

    public function getCards()
    {
        return $this->cards;
    }
}
