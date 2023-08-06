<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use PHPUnit\Framework\TestCase;

class GameStateTest extends TestCase
{
    /**
     * Test that the GameState class can be created.
     */
    public function testGameState(): void
    {
        $gameState = new GameState();

        $this->assertInstanceOf(
            GameState::class,
            $gameState
        );

        $this->assertInstanceOf(
            CardHand::class,
            $gameState->getTableCards()
        );

        $this->assertInstanceOf(
            CardHand::class,
            $gameState->getTrashCards()
        );

        $this->assertEquals(
            0,
            $gameState->getPot()
        );

        $this->assertEquals(
            10,
            $gameState->getSmallBlind()
        );

        $this->assertEquals(
            20,
            $gameState->getBigBlind()
        );
    }

    /**
     * Test getTableCardsAsString
     */
    public function testGetTableCardsAsString(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            [],
            $gameState->getTableCardsAsString()
        );

        $card1 = new Card("♠", "A");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");

        $gameState->getTableCards()->addCard($card1);
        $gameState->getTableCards()->addCard($card2);
        $gameState->getTableCards()->addCard($card3);

        $this->assertEquals(
            [$card1, $card2, $card3],
            $gameState->getTableCardsAsString()
        );
    }

    /**
     * Test getNumOfTableCards
     */
    public function testGetNumOfTableCards(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            0,
            $gameState->getNumOfTableCards()
        );

        $card1 = new Card("♠", "A");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");

        $gameState->getTableCards()->addCard($card1);
        $gameState->addTableCard($card2);
        $gameState->getTableCards()->addCard($card3);

        $this->assertEquals(
            3,
            $gameState->getNumOfTableCards()
        );

        $gameState->resetTableCards();

        $this->assertEquals(
            0,
            $gameState->getNumOfTableCards()
        );
    }

    /**
     * Test addTrashCard
     */
    public function testAddTrashCard(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            0,
            count($gameState->getTrashCards()->getCards())
        );

        $card1 = new Card("♠", "A");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");

        $gameState->addTrashCard($card1);
        $gameState->addTrashCard($card2);
        $gameState->addTrashCard($card3);

        $this->assertEquals(
            3,
            count($gameState->getTrashCards()->getCards())
        );
    }

    /**
     * Test setPot
     */
    public function testSetPot(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            0,
            $gameState->getPot()
        );

        $gameState->setPot(100);

        $this->assertEquals(
            100,
            $gameState->getPot()
        );
    }

    /**
     * Test setSmallBlind
     */
    public function testSetSmallBlind(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            10,
            $gameState->getSmallBlind()
        );

        $gameState->setSmallBlind(100);

        $this->assertEquals(
            100,
            $gameState->getSmallBlind()
        );
    }

    /**
     * Test setBigBlind
     */
    public function testSetBigBlind(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            20,
            $gameState->getBigBlind()
        );

        $gameState->setBigBlind(100);

        $this->assertEquals(
            100,
            $gameState->getBigBlind()
        );
    }

    /**
     * Test addToPot and resetPot
     */
    public function testAddToPotAndResetPot(): void
    {
        $gameState = new GameState();

        $this->assertEquals(
            0,
            $gameState->getPot()
        );

        $gameState->addToPot(100);

        $this->assertEquals(
            100,
            $gameState->getPot()
        );

        $gameState->addToPot(100);

        $this->assertEquals(
            200,
            $gameState->getPot()
        );

        $gameState->resetPot();

        $this->assertEquals(
            0,
            $gameState->getPot()
        );
    }
    
}