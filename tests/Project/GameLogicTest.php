<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use PHPUnit\Framework\TestCase;

class GameLogicTest extends TestCase
{
    /**
     * Test isRoundOver
     */
    public function testIsRoundOver(): void
    {
        $gameLogic = new GameLogic();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();

        $this->assertFalse(
            $gameLogic->isRoundOver($players)
        );

        $players[1]->getPlayerActions()->setHasFolded();
        $players[2]->getPlayerActions()->setHasFolded();

        $this->assertTrue(
            $gameLogic->isRoundOver($players)
        );

        $players[3]->getPlayerActions()->setHasFolded();

        $this->assertTrue(
            $gameLogic->isRoundOver($players)
        );
    }

    /**
     * Test getHighestBet
     */
    public function testGetHighestBet(): void
    {
        $gameLogic = new GameLogic();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->setBets(10);
        $players[1]->setBets(20);
        $players[2]->setBets(30);
        $players[3]->setBets(40);

        $this->assertEquals(
            40,
            $gameLogic->getHighestBet($players)
        );

        $players[3]->setBets(50);

        $this->assertEquals(
            50,
            $gameLogic->getHighestBet($players)
        );
    }

    /**
     * Test isPlayerReady
     */
    public function testIsPlayerReady(): void
    {
        $player1 = new ProjectPlayer("player1", 100);
        $players = [
            $player1,
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->setBets(10);
        $players[1]->setBets(20);
        $players[2]->setBets(30);
        $players[3]->setBets(40);

        $players[0]->getPlayerActions()->addToRoundActions("raise");

        $gameLogic = new GameLogic();

        $this->assertFalse(
            $gameLogic->isPlayerReady($player1, $players)
        );

        $players[0]->getPlayerActions()->addToRoundActions("call");
        $players[0]->setBets(40);

        $this->assertTrue(
            $gameLogic->isPlayerReady($player1, $players)
        );
    }

    /**
     * Test getNumberOfFoldedPlayers
     */
    public function testGetNumberOfFoldedPlayers(): void
    {
        $gameLogic = new GameLogic();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();

        $this->assertEquals(
            1,
            $gameLogic->getNumberOfFoldedPlayers($players)
        );

        $players[1]->getPlayerActions()->setHasFolded();
        $players[2]->getPlayerActions()->setHasFolded();

        $this->assertEquals(
            3,
            $gameLogic->getNumberOfFoldedPlayers($players)
        );

        $players[3]->getPlayerActions()->setHasFolded();

        $this->assertEquals(
            4,
            $gameLogic->getNumberOfFoldedPlayers($players)
        );
    }

    /**
     * Test checkNextStage
     */
    public function testCheckNextStage(): void
    {
        $gameLogic = new GameLogic();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->addToRoundActions("call");
        $players[1]->getPlayerActions()->addToRoundActions("call");
        $players[2]->getPlayerActions()->addToRoundActions("call");

        $this->assertFalse(
            $gameLogic->checkNextStage($players)
        );

        $players[0]->getPlayerActions()->addToRoundActions("check");
        $players[1]->getPlayerActions()->addToRoundActions("check");
        $players[2]->getPlayerActions()->addToRoundActions("check");
        $players[3]->getPlayerActions()->addToRoundActions("check");

        $this->assertTrue(
            $gameLogic->checkNextStage($players)
        );
    }

    /**
     * Test getWinner by fold
     */
    public function testGetWinnerByFold(): void
    {
        $gameLogic = new GameLogic();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();
        $players[1]->getPlayerActions()->setHasFolded();
        $players[2]->getPlayerActions()->setHasFolded();

        $this->assertEquals(
            $players[3],
            $gameLogic->getWinner($players)
        );
    }

    /**
     * Test getWinner by hand
     */
    public function testGetWinnerByHand(): void
    {
        $gameLogic = new GameLogic();
        $cardHands = new CardHands();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();
        $players[1]->getPlayerActions()->setHasFolded();
        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♥", "3"));
        $cardHand->addCard(new Card("♥", "4"));
        $cardHand->addCard(new Card("♥", "7"));
        $cardHand->addCard(new Card("♥", "8"));
        $cardHand->addCard(new Card("♦", "10"));
        $players[2]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[2]->getHand());
        $cardValue = $cardValue*100;
        $cardValue += $cardHands->checkHighCardAceHigh($players[2]->getHand())->getValue();

        $players[2]->setHandValue($cardValue);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♥", "A"));
        $cardHand->addCard(new Card("♥", "K"));
        $cardHand->addCard(new Card("♥", "Q"));
        $cardHand->addCard(new Card("♥", "J"));
        $cardHand->addCard(new Card("♥", "10"));
        $players[3]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[3]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[3]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[3]->setHandValue($cardValue);

        $this->assertEquals(
            $players[3],
            $gameLogic->getWinner($players)
        );
    }

    /**
     * Test isTied
     */
    public function testIsTied(): void
    {
        $gameLogic = new GameLogic();
        $cardHands = new CardHands();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();
        $players[1]->getPlayerActions()->setHasFolded();
        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♦", "A"));
        $cardHand->addCard(new Card("♦", "K"));
        $cardHand->addCard(new Card("♦", "Q"));
        $cardHand->addCard(new Card("♦", "J"));
        $cardHand->addCard(new Card("♦", "10"));
        $players[2]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[2]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[2]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[2]->setHandValue($cardValue);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♥", "A"));
        $cardHand->addCard(new Card("♥", "K"));
        $cardHand->addCard(new Card("♥", "Q"));
        $cardHand->addCard(new Card("♥", "J"));
        $cardHand->addCard(new Card("♥", "10"));
        $players[3]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[3]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[3]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[3]->setHandValue($cardValue);

        $this->assertTrue(
            $gameLogic->isTied($players)
        );
    }
    /**
     * Test isTied false
     */
    public function testIsTiedFalse(): void
    {
        $gameLogic = new GameLogic();
        $cardHands = new CardHands();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();
        $players[1]->getPlayerActions()->setHasFolded();
        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♦", "A"));
        $cardHand->addCard(new Card("♦", "K"));
        $cardHand->addCard(new Card("♦", "Q"));
        $cardHand->addCard(new Card("♦", "J"));
        $cardHand->addCard(new Card("♦", "10"));
        $players[2]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[2]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[2]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[2]->setHandValue($cardValue);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♥", "9"));
        $cardHand->addCard(new Card("♥", "K"));
        $cardHand->addCard(new Card("♥", "Q"));
        $cardHand->addCard(new Card("♥", "J"));
        $cardHand->addCard(new Card("♥", "10"));
        $players[3]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[3]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[3]->getHand())->getValue();
        if ($highCardValue == 'K') {
            $highCardValue = 13;
        }
        $cardValue += $highCardValue;

        $players[3]->setHandValue($cardValue);

        $this->assertFalse(
            $gameLogic->isTied($players)
        );
    }

    /**
     * Test getTiedWinners
     */
    public function testGetTiedWinners(): void
    {
        $gameLogic = new GameLogic();
        $cardHands = new CardHands();

        $players = [
            new ProjectPlayer("player1", 100),
            new ProjectPlayer("player2", 100),
            new ProjectPlayer("player3", 100),
            new ProjectPlayer("player4", 100),
        ];

        $players[0]->getPlayerActions()->setHasFolded();
        $players[1]->getPlayerActions()->setHasFolded();
        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♦", "A"));
        $cardHand->addCard(new Card("♦", "K"));
        $cardHand->addCard(new Card("♦", "Q"));
        $cardHand->addCard(new Card("♦", "J"));
        $cardHand->addCard(new Card("♦", "10"));
        $players[2]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[2]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[2]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[2]->setHandValue($cardValue);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card("♥", "A"));
        $cardHand->addCard(new Card("♥", "K"));
        $cardHand->addCard(new Card("♥", "Q"));
        $cardHand->addCard(new Card("♥", "J"));
        $cardHand->addCard(new Card("♥", "10"));
        $players[3]->setHand($cardHand);

        $cardValue = $cardHands->checkBestHand($players[3]->getHand());
        $cardValue = $cardValue*100;
        $highCardValue = $cardHands->checkHighCardAceHigh($players[3]->getHand())->getValue();
        if ($highCardValue == 'A') {
            $highCardValue = 14;
        }
        $cardValue += $highCardValue;

        $players[3]->setHandValue($cardValue);

        $this->assertEquals(
            [$players[2], $players[3]],
            $gameLogic->getTiedWinners($players)
        );

    }
}