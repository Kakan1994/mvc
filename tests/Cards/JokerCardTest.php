<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

class JokerCardTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $jokerCard = new JokerCard();
        $this->assertInstanceOf("\App\Cards\JokerCard", $jokerCard);

        $res = $jokerCard->getSuit();
        $exp = 'Joker';
        $this->assertEquals($exp, $res);

        $res = $jokerCard->getValue();
        $exp = 'Joker';
        $this->assertEquals($exp, $res);
    }

    /**
     * Test __toString method.
     */
    public function testToString(): void
    {
        $jokerCard = new JokerCard();
        $res = $jokerCard->__toString();
        $exp = html_entity_decode('&#x1F0DF;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Joker
        $this->assertEquals($exp, $res);
    }
}
