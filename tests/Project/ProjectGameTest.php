<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use PHPUnit\Framework\TestCase;

class ProjectGameTest extends TestCase
{

    public function setUpGame(): ProjectGame
    {
        $deck = new DeckOfCards();
        $cardHands = new CardHands();
        $gameLogic = new GameLogic();
        $gameData = new GameData();
        $player1 = new ProjectPlayer("Player 1", 1000);
        $matt = new NPCMatt("Matt", 1000);
        $steve = new NPCSteve("Steve", 1000);
        $gameQueue = new GameQueue([$player1, $matt, $steve]);
        $gameState = new GameState();
        $projectGame = new ProjectGame(
            $deck,
            $cardHands,
            $gameLogic,
            $gameData,
            $gameQueue,
            $gameState
        );

        return $projectGame;
    }
    /**
     * Test the constructor.
     */
    public function testConstructor(): void
    {
        $projectGame = $this->setUpGame();

        $this->assertInstanceOf(
            ProjectGame::class,
            $projectGame
        );
    }

    /**
     * Test setQueAndRoles() method.
     */
    public function testSetQueAndRoles(): void
    {
        $projectGame = $this->setUpGame();

        $projectGame->setQueAndRoles();

        $this->assertIsArray(
            $projectGame->getQue()
        );
    }

    /**
     * Test takeBlinds() method.
     */
    public function testTakeBlinds(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();

        $projectGame->takeBlinds();

        $this->assertEquals(
            30,
            $projectGame->getPot()
        );
    }

    /**
     * Test getGameState() method.
     */
    public function testGetGameState(): void
    {
        $projectGame = $this->setUpGame();

        $this->assertInstanceOf(
            GameState::class,
            $projectGame->getGameState()
        );
    }

    /**
     * Test dealCards() method.
     */
    public function testDealCards(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();

        $res = $projectGame->dealCards();

        $this->assertIsArray(
            $res
        );
    }

    /**
     * Test getPossibleActions() method.
     */
    public function testGetPossibleActions(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $player = $projectGame->getFirstPlayer();

        $res = $projectGame->getPossibleActions($player);
        $exp = 2;
        $this->assertEquals(
            $exp,
            $res
        );

        $projectGame->takeBlinds();
        $player = $projectGame->getFirstPlayer();
        $res = $projectGame->getPossibleActions($player);
        $exp = 3;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test dequePlayer() method.
     */
    public function testDequePlayer(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $resPlayer = $projectGame->getFirstPlayer();

        $projectGame->dequePlayer();

        $exp = $projectGame->getFirstPlayer();
        
        $this->assertNotEquals(
            $exp,
            $resPlayer
        );

        $res = $projectGame->getQue();
        $exp = 2;
        $this->assertEquals(
            $exp,
            count($res)
        
        );

        $projectGame->enquePlayer($resPlayer);

        $res = $projectGame->getQue();
        $exp = 3;
        $this->assertEquals(
            $exp,
            count($res)
        );
    }

    /**
     * Test roundOver() method.
     */
    public function testRoundOver(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $res = $projectGame->roundOver();
        $exp = false;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getHighestBet() method.
     */
    public function testGetHighestBet(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $res = $projectGame->getHighestBet();
        $exp = 20;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test addToPot() method.
     */
    public function testAddToPot(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $projectGame->addToPot(10);
        $res = $projectGame->getPot();
        $exp = 40;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getBigBlind() method.
     */
    public function testGetBigBlind(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $res = $projectGame->getBigBlind();
        $exp = 20;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getSmallBlind() method.
     */
    public function testGetSmallBlind(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $res = $projectGame->getSmallBlind();
        $exp = 10;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test checkNextStage() method.
     */
    public function testCheckNextStage(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        
        $res = $projectGame->checkNextStage();
        $exp = false;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test setNextStage() method.
     */
    public function testSetNextStage(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();

        $res = $projectGame->getFirstPlayer();
        $projectGame->setNextStage();
        $exp = $projectGame->getFirstPlayer();
        $this->assertNotEquals(
            $exp,
            $res
        );
    }

    /**
     * Test setNewRound() method.
     */
    public function testSetNewRound(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $projectGame->setNewRound();

        $res = $projectGame->getPot();
        $exp = 30;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * setNewRoundTie() method.
     */
    public function testSetNewRoundTie(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $projectGame->setNewRoundTie();

        $res = $projectGame->getGameState()->getPot();
        $exp = 30;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getWinner() method.
     */
    public function testGetWinner(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $exp = $projectGame->getFirstPlayer();

        $res = $projectGame->getWinner();
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test setFlop() method.
     */
    public function testSetFlop(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $projectGame->setFlop();

        $res = $projectGame->getGameState()->getPot();
        $exp = 0;
        $this->assertEquals(
            $exp,
            $res
        );
        $res = $projectGame->getTableCards();
        $exp = 3;
        $this->assertEquals(
            $exp,
            count($res)
        );
    }

    /**
     * Test setTurn() method.
     */
    public function testSetTurn(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $projectGame->setFlop();
        $projectGame->setTurn();

        $res = $projectGame->getGameState()->getPot();
        $exp = 0;
        $this->assertEquals(
            $exp,
            $res
        );
        $res = $projectGame->getTableCards();
        $exp = 4;
        $this->assertEquals(
            $exp,
            count($res)
        );
    }

    /**
     * Test setRiver() method.
     */
    public function testSetRiver(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $projectGame->setFlop();
        $projectGame->setTurn();
        $projectGame->setRiver();

        $res = $projectGame->getGameState()->getPot();
        $exp = 0;
        $this->assertEquals(
            $exp,
            $res
        );
        $res = $projectGame->getTableCards();
        $exp = 5;
        $this->assertEquals(
            $exp,
            count($res)
        );
    }

    /**
     * Test isWinnerByFold() method.
     */
    public function testIsWinnerByFold(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $projectGame->getFirstPlayer()->getPlayerActions()->setHasFolded();
        $players = $projectGame->getQue();
        $players[1]->getPlayerActions()->setHasFolded();

        $res = $projectGame->isWinnerByFold();
        $exp = true;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test checkPreOrPostFlop() method.
     */
    public function testCheckPreOrPostFlop(): void
    {
        $projectGame = $this->setUpGame();
        $res = $projectGame->checkPreOrPostFlop();
        $exp = "pre";

        $this->assertEquals(
            $exp,
            $res
        );

        $projectGame->setQueAndRoles();
        $projectGame->dealCards();
        $projectGame->takeBlinds();
        $projectGame->setFlop();
        $res = $projectGame->checkPreOrPostFlop();
        $exp = "post";

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getPlayer() method.
     */
    public function testGetPlayer(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $res = $projectGame->getPlayer("Player 1");
        $exp = $projectGame->getFirstPlayer();

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test isTied() method.
     */
    public function testIsTied(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $players = $projectGame->getQue();
        $players[1]->getPlayerActions()->setHasFolded();
        $players[2]->getPlayerActions()->setHasFolded();
        $res = $projectGame->isTied();
        $exp = true;

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test setGameData() method.
     */
    public function testSetGameData(): void
    {
        $projectGame = $this->setUpGame();
        $projectGame->setQueAndRoles();
        $players = $projectGame->getQue();
        $players[1]->getPlayerActions()->setHasFolded();
        $players[2]->getPlayerActions()->setHasFolded();
        $res = $projectGame->setGameData();

        $this->assertInstanceOf(
            GameData::class,
            $res
        );
    }

    /**
     * Test getAndSetBestHands() method.
     */
    public function testGetAndSetBestHands(): void
    {
        $projectGame = $this->setUpGame();
        $tableCard1 = new Card("♠", "A");
        $tableCard2 = new Card("♠", "K");
        $tableCard3 = new Card("♠", "Q");
        $tableCard4 = new Card("♠", "7");
        $tableCard5 = new Card("♥", "7");
        $tableCards = [$tableCard1, $tableCard2, $tableCard3, $tableCard4, $tableCard5];
        foreach ($tableCards as $card) {
            $projectGame->getGameState()->getTableCards()->addCard($card);
        }
        $player1 = $projectGame->getFirstPlayer();
        $player1->getHand()->addCard(new Card("♠", "J"));
        $player1->getHand()->addCard(new Card("♠", "10"));

        $player2 = $projectGame->getQue()[1];
        $player2->getHand()->addCard(new Card("♦", "7"));
        $player2->getHand()->addCard(new Card("♣", "7"));

        $player3 = $projectGame->getQue()[2];
        $player3->getHand()->addCard(new Card("♦", "A"));
        $player3->getHand()->addCard(new Card("♣", "7"));

        $res = $projectGame->getAndSetBestHands();
        $exp = "done";

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getAndSetBestHands() method.
     */
    public function testGetAndSetBestHands2(): void
    {
        $projectGame = $this->setUpGame();
        $tableCard1 = new Card("♠", "A");
        $tableCard2 = new Card("♠", "K");
        $tableCard3 = new Card("♠", "Q");
        $tableCard4 = new Card("♠", "7");
        $tableCard5 = new Card("♥", "7");
        $tableCards = [$tableCard1, $tableCard2, $tableCard3, $tableCard4, $tableCard5];
        foreach ($tableCards as $card) {
            $projectGame->getGameState()->getTableCards()->addCard($card);
        }
        $player1 = $projectGame->getFirstPlayer();
        $player1->getHand()->addCard(new Card("♠", "2"));
        $player1->getHand()->addCard(new Card("♠", "3"));

        $player2 = $projectGame->getQue()[1];
        $player2->getHand()->addCard(new Card("♦", "J"));
        $player2->getHand()->addCard(new Card("♣", "10"));

        $player3 = $projectGame->getQue()[2];
        $player3->getHand()->addCard(new Card("♦", "2"));
        $player3->getHand()->addCard(new Card("♣", "7"));

        $res = $projectGame->getAndSetBestHands();
        $exp = "done";

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getAndSetBestHands() method.
     */
    public function testGetAndSetBestHands3(): void
    {
        $projectGame = $this->setUpGame();
        $tableCard1 = new Card("♠", "A");
        $tableCard2 = new Card("♠", "K");
        $tableCard3 = new Card("♠", "Q");
        $tableCard4 = new Card("♠", "7");
        $tableCard5 = new Card("♥", "6");
        $tableCards = [$tableCard1, $tableCard2, $tableCard3, $tableCard4, $tableCard5];
        foreach ($tableCards as $card) {
            $projectGame->getGameState()->getTableCards()->addCard($card);
        }
        $player1 = $projectGame->getFirstPlayer();
        $player1->getHand()->addCard(new Card("♥", "6"));
        $player1->getHand()->addCard(new Card("♥", "7"));

        $player2 = $projectGame->getQue()[1];
        $player2->getHand()->addCard(new Card("♦", "A"));
        $player2->getHand()->addCard(new Card("♣", "10"));

        $player3 = $projectGame->getQue()[2];
        $player3->getHand()->addCard(new Card("♦", "2"));
        $player3->getHand()->addCard(new Card("♣", "J"));

        $res = $projectGame->getAndSetBestHands();
        $exp = "done";

        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getAndSetBestHands() method.
     */
    public function testGetAndSetBestHands4(): void
    {
        $projectGame = $this->setUpGame();
        $tableCard1 = new Card("♠", "2");
        $tableCard2 = new Card("♠", "3");
        $tableCard3 = new Card("♠", "5");
        $tableCard4 = new Card("♠", "8");
        $tableCard5 = new Card("♥", "6");
        $tableCards = [$tableCard1, $tableCard2, $tableCard3, $tableCard4, $tableCard5];
        foreach ($tableCards as $card) {
            $projectGame->getGameState()->getTableCards()->addCard($card);
        }
        $player1 = $projectGame->getFirstPlayer();
        $player1->getHand()->addCard(new Card("♥", "K"));
        $player1->getHand()->addCard(new Card("♥", "J"));

        $player2 = $projectGame->getQue()[1];
        $player2->getHand()->addCard(new Card("♦", "Q"));
        $player2->getHand()->addCard(new Card("♣", "10"));

        $player3 = $projectGame->getQue()[2];
        $player3->getHand()->addCard(new Card("♦", "10"));
        $player3->getHand()->addCard(new Card("♣", "J"));

        $res = $projectGame->getAndSetBestHands();
        $exp = "done";

        $this->assertEquals(
            $exp,
            $res
        );
    }
}
