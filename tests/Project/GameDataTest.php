<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

use PHPUnit\Framework\TestCase;

class GameDataTest extends TestCase
{
    public function testGameData(): void
    {
        $gameData = new GameData();

        $this->assertInstanceOf(
            GameData::class,
            $gameData
        );
    }

    public function testSetAndGetPlayers(): void
    {
        $gameData = new GameData();
        $gameData->setPlayers(["player1", "player2"]);

        $this->assertIsArray(
            $gameData->getPlayers()
        );

        $this->assertEquals(
            ["player1", "player2"],
            $gameData->getPlayers()
        );
    }

    public function testSetAndGetGameStage(): void
    {
        $gameData = new GameData();
        $gameData->setGameStage(0);

        $this->assertIsString(
            $gameData->getGameStage()
        );
        $this->assertEquals(
            "pre-flop",
            $gameData->getGameStage()
        );

        $gameData->setGameStage(3);

        $this->assertIsString(
            $gameData->getGameStage()
        );

        $this->assertEquals(
            "flop",
            $gameData->getGameStage()
        );

        $gameData->setGameStage(4);

        $this->assertEquals(
            "turn",
            $gameData->getGameStage()
        );

        $gameData->setGameStage(5);

        $this->assertEquals(
            "river",
            $gameData->getGameStage()
        );
    }
    
    public function testSetAndGetPot(): void
    {
        $gameData = new GameData();
        $gameData->setPot(100);

        $this->assertIsInt(
            $gameData->getPot()
        );

        $this->assertEquals(
            100,
            $gameData->getPot()
        );
    }

    /**
     * Test that the table cards are set and retrieved correctly
     */
    public function testSetAndGetTableCards(): void
    {
        $gameData = new GameData();
        $card1 = new Card("♥", "A");
        $card2 = new Card("♠", "A");
        $card3 = new Card("♦", "A");
        $gameData->setTableCards([$card1, $card2, $card3]);

        $this->assertIsArray(
            $gameData->getTableCards()
        );

        $this->assertEquals(
            [$card1, $card2, $card3],
            $gameData->getTableCards()
        );
    }

    /**
     * Test that the round winner is set and retrieved correctly
     */
    public function testSetAndGetRoundWinner(): void
    {
        $gameData = new GameData();
        $player = new ProjectPlayer("Matt", 100);
        $gameData->setRoundWinner($player);

        $this->assertInstanceOf(
            ProjectPlayer::class,
            $gameData->getRoundWinner()
        );

        $this->assertEquals(
            $player,
            $gameData->getRoundWinner()
        );
    }

    /**
     * Test that the winner hand is set and retrieved correctly
     */
    public function testSetAndGetWinnerHand(): void
    {
        $gameData = new GameData();
        $card1 = new Card("♥", "A");
        $card2 = new Card("♠", "A");
        $card3 = new Card("♦", "A");
        $card4 = new Card("♣", "A");
        $card5 = new Card("♦", "K");
        $hand = [$card1, $card2, $card3, $card4, $card5];
        $gameData->setWinnerHand($hand);

        $this->assertIsArray(
            $gameData->getWinnerHand()
        );

        $this->assertEquals(
            $hand,
            $gameData->getWinnerHand()
        );
    }
}