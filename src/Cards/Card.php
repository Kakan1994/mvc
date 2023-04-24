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

    public function getCardText(): string
    {
        return $this->suit . $this->value;
    }


    public function __toString() {
        $unicode = '';

        switch ($this->suit) {
            case '♠':
                $unicode = '&#x1F0A'; // Spades
                break;
            case '♥':
                $unicode = '&#x1F0B'; // Hearts
                break;
            case '♦':
                $unicode = '&#x1F0C'; // Diamonds
                break;
            case '♣':
                $unicode = '&#x1F0D'; // Clubs
                break;
            default:
                $unicode = '';
        }

        switch ($this->value) {
            case 'A':
                $unicode .= '1';
                break;
            case '10':
                $unicode .= 'A';
                break;
            case 'J':
                $unicode .= 'B';
                break;
            case 'Q':
                $unicode .= 'D';
                break;
            case 'K':
                $unicode .= 'E';
                break;
            default:
                $unicode .= $this->value;
        }

        return html_entity_decode($unicode . ';', ENT_COMPAT, 'UTF-8');
    }
}
