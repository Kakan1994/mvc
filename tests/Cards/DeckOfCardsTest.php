<?php

namespace App\Cards;

use PHPUnit\Framework\TestCase;

class DeckOfCardsTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $deckOfCards = new DeckOfCards();
        $this->assertInstanceOf("\App\Cards\DeckOfCards", $deckOfCards);

        $res = $deckOfCards->getCards();
        $res = count($res);
        $exp = 52;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test shuffle method.
     */
    public function testShuffle(): void
    {
        $deckOfCards = new DeckOfCards();
        $deckOfCards->shuffle();

        $res = $deckOfCards->getCards();
        $this->assertIsArray($res);
        $this->assertNotEquals($res, range(1, 52)); // Check that the array is not in order
    }

    /**
     * Test drawCard method.
     */
    public function testDrawCard(): void
    {
        $deckOfCards = new DeckOfCards();
        $card = $deckOfCards->draw();

        $res = $deckOfCards->getCards();
        $this->assertIsArray($res);
        $this->assertNotContains($card, $res); // Check that the card is not in the deck
    }

    /**
     * Test draw many cards.
     */
    public function testDrawManyCards(): void
    {
        $deckOfCards = new DeckOfCards();
        $cards = $deckOfCards->draw(5);

        $res = $deckOfCards->getCards();
        $this->assertIsArray($res);
        $this->assertNotContains($cards[0], $res); // Check that the card is not in the deck
        $this->assertNotContains($cards[1], $res); // Check that the card is not in the deck
        $this->assertNotContains($cards[2], $res); // Check that the card is not in the deck
        $this->assertNotContains($cards[3], $res); // Check that the card is not in the deck
        $this->assertNotContains($cards[4], $res); // Check that the card is not in the deck
    }
}
