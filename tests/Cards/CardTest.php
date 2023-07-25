<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

class CardTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject()
    {
        $card = new Card('♥', 'A');
        $this->assertInstanceOf("\App\Cards\Card", $card);

        $res = $card->getValue();
        $exp = 'A';
        $this->assertEquals($exp, $res);

        $res = $card->getSuit();
        $exp = '♥';
        $this->assertEquals($exp, $res);
    }



    /**
     * Test getCardText method.
     */
    public function testGetCardText()
    {
        $card = new Card('♥', 'A');
        $res = $card->getCardText();
        $exp = '♥A';
        $this->assertIsString($res);
        $this->assertEquals($exp, $res);
    }



    /**
     * Test __toString method.
     */
    public function testToString()
    {
        $card = new Card('♥', 'A');
        $res = $card->__toString();
        $exp = html_entity_decode('&#x1F0B1;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Heart Ace
        $this->assertEquals($exp, $res);

        $card = new Card('♦', '10');
        $res = $card->__toString();
        $exp = html_entity_decode('&#x1F0CA;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Diamond 10
        $this->assertEquals($exp, $res);

        $card = new Card('♠', 'J');
        $res = $card->__toString();
        $exp = html_entity_decode('&#x1F0AB;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Spades Jack
        $this->assertEquals($exp, $res);

        $card = new Card('♣', 'Q');
        $res = $card->__toString();
        $exp = html_entity_decode('&#x1F0DD;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Clubs Queen
        $this->assertEquals($exp, $res);

        $card = new Card('♠', '7');
        $res = $card->__toString();
        $exp = html_entity_decode('&#x1F0A7;', ENT_COMPAT, 'UTF-8'); // Expected unicode for Spades 7
        $this->assertEquals($exp, $res);
    }
}
