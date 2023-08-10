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

    /**
     * Test getCardsAsArrayProj method.
     */
    public function testGetCardsAsArrayProj(): void
    {
        $cardHand = new CardHand();
        $card = new Card('♥', 'A');
        $cardHand->addCard($card);

        $res = $cardHand->getCardsAsArrayProj();
        $exp = ['AH'];
        $this->assertEquals($exp, $res);

        $card = new Card('♦', '10');
        $cardHand->addCard($card);

        $res = $cardHand->getCardsAsArrayProj();
        $exp = ['AH', 'TD'];
        $this->assertEquals($exp, $res);

        $card = new Card('♠', 'J');
        $cardHand->addCard($card);

        $res = $cardHand->getCardsAsArrayProj();
        $exp = ['AH', 'TD', 'JS'];
        $this->assertEquals($exp, $res);

        $card = new Card('♣', 'Q');
        $cardHand->addCard($card);

        $res = $cardHand->getCardsAsArrayProj();
        $exp = ['AH', 'TD', 'JS', 'QC'];
        $this->assertEquals($exp, $res);
    }
}
