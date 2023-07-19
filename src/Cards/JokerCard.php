<?php

namespace App\Cards;

class JokerCard extends Card
{
    public function __construct(string $suit = '♠', string $value = 'Joker')
    {
        parent::__construct($suit, $value);
    }

    public function __toString()
    {
        return $this->getValue();
    }
}
