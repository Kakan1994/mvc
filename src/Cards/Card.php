<?php

namespace App\Cards;

class Card
{
    private string $suit;
    private string $value;

    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    public function getSuit(): string
    {
        return $this->suit;
    }

    public function getValue(): string
    {
        return $this->value;
    }

    public function getCardText(): string
    {
        return $this->suit . $this->value;
    }


    public function __toString()
    {
        $suitMapping = [
            '♠' => '&#x1F0A', // Spades
            '♥' => '&#x1F0B', // Hearts
            '♦' => '&#x1F0C', // Diamonds
            '♣' => '&#x1F0D', // Clubs
        ];

        $valueMapping = [
            'A' => '1',
            '10' => 'A',
            'J' => 'B',
            'Q' => 'D',
            'K' => 'E'
        ];

        $unicode = $suitMapping[$this->suit] ?? '';
        $unicode .= $valueMapping[$this->value] ?? $this->value;

        return html_entity_decode($unicode . ';', ENT_COMPAT, 'UTF-8');
    }

}
