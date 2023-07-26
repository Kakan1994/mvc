<?php

namespace App\Cards;

/**
 * Class JokerCard
 *
 * Represents a joker card.
 */
class JokerCard extends Card
{
    /**
     * JokerCard constructor.
     *
     * @param string $suit   The suit of the card.
     * @param string $value  The value of the card.
     */
    public function __construct(string $suit = 'Joker', string $value = 'Joker')
    {
        parent::__construct($suit, $value);
    }

    /**
     * Get the joker unicode character.
     *
     * @return string The joker unicode character.
     */
    public function __toString()
    {
        return html_entity_decode('&#x1F0DF;', ENT_COMPAT, 'UTF-8');
    }
}
