<?php

namespace App\Cards;

class Card {
    private $suit;
    private $value;

    public function __construct($suit, $value) {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit() {
        return $this->suit;
    }

    public function getValue() {
        return $this->value;
    }

    public function __toString() {
        return $this->value . $this->suit;
    }
}
