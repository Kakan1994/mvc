<?php

namespace App\Cards;

/**
 * Class Card
 * @package App\Cards
 * 
 * Represents a playing card with a suit and a value.
 */
class Card
{
    /**
     * @var string $suit   The suit of the card.
     */
    private string $suit;

    /**
     * @var string $value  The value of the card.
     */
    private string $value;

    /**
     * Card constructor.
     * @param string $suit   The suit of the card.
     * @param string $value  The value of the card.
     */
    public function __construct(string $suit, string $value)
    {
        $this->suit = $suit;
        $this->value = $value;
    }

    /**
     * Get the suit of the card.
     * 
     * @return string The suit of the card.
     */
    public function getSuit(): string
    {
        return $this->suit;
    }

    /**
     * Get the value of the card.
     * 
     * @return string The value of the card.
     */
    public function getValue(): string
    {
        return $this->value;
    }

    /**
     * Get the card as a string in the format suit + value.
     *
     * @return string The card as a string.
     */
    public function getCardText(): string
    {
        return $this->suit . $this->value;
    }

    /**
     * Convert the card to a string in a unicode format.
     *
     * @return string The card in unicode format.
     */
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
