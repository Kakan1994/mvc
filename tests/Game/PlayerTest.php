<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;

class PlayerTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject()
    {
        $player = new Player('Player');
        $this->assertInstanceOf("\App\Game\Player", $player);

        $res = $player->getName();
        $exp = 'Player';
        $this->assertEquals($exp, $res);
    }

    /**
     * Test drawCard method.
     */
    public function testDrawCard()
    {
        $player = new Player('Player');
        $deck = new DeckOfCards();
        $player->drawCard($deck);
        $res = $player->getHand()->getCards();
        $exp = 1;
        $this->assertCount($exp, $res);
    }

    /**
     * Test getScore method.
     */
    public function testGetScore()
    {
        $player = new Player('Player');
        $res = $player->getScore();
        $exp = 0;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test addScore method.
     */
    public function testAddScore()
    {
        $player = new Player('Player');
        $player->addScore(10);
        $res = $player->getScore();
        $exp = 10;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test clearHand method.
     */
    public function testClearHand()
    {
        $player = new Player('Player');
        $deck = new DeckOfCards();
        $player->drawCard($deck);
        $player->clearHand();
        $res = $player->getHand()->getCards();
        $exp = 0;
        $this->assertCount($exp, $res);
    }
}