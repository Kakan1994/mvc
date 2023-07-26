<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

class CardHandTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $cardHand = new CardHand();
        $this->assertInstanceOf("\App\Cards\CardHand", $cardHand);

        $res = $cardHand->getCards();
        $exp = [];
        $this->assertEquals($exp, $res);
    }



    /**
     * Test addCard and getCards methods.
     */
    public function testAddCard(): void
    {
        $cardHand = new CardHand();
        $card = new Card('♥', 'A');
        $cardHand->addCard($card);

        $res = $cardHand->getCards();
        $exp = [$card];
        $this->assertEquals($exp, $res);
    }



    /**
     * Test getCardsAsArray method.
     */
    public function testGetCardsAsArray(): void
    {
        $cardHand = new CardHand();
        $card = new Card('♥', 'A');
        $cardHand->addCard($card);

        $res = $cardHand->getCardsAsArray();
        $exp = ['♥A'];
        $this->assertEquals($exp, $res);
    }
}
