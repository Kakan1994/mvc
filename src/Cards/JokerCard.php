<?php

namespace App\Cards;

class JokerCard extends Card {
    public function __construct($suit = null, $value = 'Joker') {
        parent::__construct($suit, $value);
    }

    public function __toString() {
        return $this->getValue();
    }
}
