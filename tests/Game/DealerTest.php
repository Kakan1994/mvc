<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

class DealerTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $dealer = new Dealer();
        $this->assertInstanceOf("\App\Game\Dealer", $dealer);

        $res = $dealer->getName();
        $exp = 'Dealer';
        $this->assertEquals($exp, $res);
    }

    /**
     * Test drawHiddenCard method.
     */
    public function testDrawHiddenCard(): void
    {
        $dealer = new Dealer();
        $deck = new DeckOfCards();
        $dealer->drawHiddenCard($deck);
        $res = $dealer->getHand()->getCards();
        $exp = 0;
        $this->assertCount($exp, $res);

        $dealer->revealHiddenCard();
        $res = $dealer->getHand()->getCards();
        $exp = 1;
        $this->assertCount($exp, $res);
    }

    /**
     * Test getScore method.
     */
    public function testGetScore(): void
    {
        $dealer = new Dealer();
        $res = $dealer->getScore();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test addScore method.
     */
    public function testAddScore(): void
    {
        $dealer = new Dealer();
        $dealer->addScore(10);
        $res = $dealer->getScore();
        $exp = 10;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test isHiddenCardRevealed method.
     */
    public function testIsHiddenCardRevealed(): void
    {
        $dealer = new Dealer();
        $desk = new DeckOfCards();

        $dealer->drawHiddenCard($desk);
        $res = $dealer->isHiddenCardRevealed();
        $exp = false;
        $this->assertEquals($exp, $res);

        $dealer->revealHiddenCard();
        $res = $dealer->isHiddenCardRevealed();
        $exp = true;
        $this->assertEquals($exp, $res);
    }
}
