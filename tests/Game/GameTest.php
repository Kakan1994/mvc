<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;
use App\Cards\DeckOfCards;
use App\Cards\Card;

class GameTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $game = new Game();
        $this->assertInstanceOf("\App\Game\Game", $game);
    }

    /**
     * Test startGame method.
     */
    public function testStartGame(): void
    {
        $game = new Game();
        $game->startGame();
        $res = $game->getDealer()->getHand()->getCards();
        $exp = 1;
        $this->assertCount($exp, $res);

        $res = $game->getPlayer()->getHand()->getCards();
        $exp = 2;
        $this->assertCount($exp, $res);

        $res = $game->getDeck()->getCards();
        $exp = 48;
        $this->assertCount($exp, $res);
    }

    /**
     * Test hit method.
     */
    public function testHit(): void
    {
        $game = new Game();
        $game->startGame();
        $game->hit();
        $res = $game->getPlayer()->getHand()->getCards();
        $exp = 3;
        $this->assertCount($exp, $res);
    }

    /**
     * Test if player doesn't get busted from hit.
     */
    public function testHitWithScoreLessThan21(): void
    {
        $game = new Game();
        $game->startGame();
        $game->hit();
        while ($game->getPlayerScore() > 20)
        {
            $game = new Game();
            $game->startGame();
            $game->hit();
        }
        

        $this->assertLessThan(21, $game->getPlayerScore());
        $this->assertFalse($game->isGameOver());
        $this->assertGreaterThan(2, $game->getPlayer()->getHand()->getCards());
    }

    /**
     * Test if player gets busted from hit.
     */
    public function testHitWithScoreMoreThan21(): void
    {
        $game = new Game();
        $game->startGame();

        while ($game->getPlayerScore() <= 21) {
            $game->hit();
            if ($game->getPlayerScore() === 21) {
                $game = new Game();
                $game->startGame();
            }
        }

        $this->assertGreaterThan(21, $game->getPlayerScore());
        $this->assertTrue($game->isGameOver());
        $this->assertGreaterThan(2, $game->getPlayer()->getHand()->getCards());
    }

    /**
     * Test getting 21 from hit.
     */
    public function testHitWithScore21(): void
    {
        $game = new Game();
        $game->startGame();
        while ($game->getPlayerScore() < 21 || $game->getPlayerScore() > 21) {
            $game->hit();
            if ($game->getPlayerScore() > 21) {
                $game = new Game();
                $game->startGame();
                $game->hit();
            }
            if ($game->getPlayerScore() === 21) {
                break;
            }
        }

        $this->assertEquals(21, $game->getPlayerScore());
        $this->assertGreaterThan(2, $game->getPlayer()->getHand()->getCards());
    }

    /**
     * Test so stand method reveals hidden card.
     */
    public function testStandRevealHiddenCard(): void
    {
        $game = new Game();
        $game->startGame();
        $game->stand();
        $this->assertGreaterThan(1, $game->getDealer()->getHand()->getCards());
    }

    /**
     * Test stand when dealer gets busted.
     */
    public function testStandWithDealerScoreMoreThan21(): void
    {
        $game = new Game();
        $game->startGame();
        $game->stand();
        while ($game->getDealerScore() <= 21) {
            $game = new Game();
            $game->startGame();
            $game->stand();
        }
        $this->assertGreaterThan(21, $game->getDealerScore());
        $this->assertGreaterThan(2, $game->getDealer()->getHand()->getCards());
    }

    /**
     * Test revealDealerCard method.
     */
    public function testRevealDealerCard(): void
    {
        $game = new Game();
        $game->startGame();
        $game->revealDealerCard();
        $this->assertGreaterThan(1, $game->getDealer()->getHand()->getCards());
    }

    /**
     * Test getLastPlayerScore method.
     */
    public function testGetLastPlayerScore(): void
    {
        $game = new Game();
        $game->startGame();
        $exp = $game->getPlayerScore();
        $game->stand();
        $game->newRound();
        $res = $game->getLastPlayerScore();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test getLastDealerScore method.
     */
    public function testGetLastDealerScore(): void
    {
        $game = new Game();
        $game->startGame();
        $game->stand();
        $exp = $game->getDealerScore();
        $game->newRound();
        $res = $game->getLastDealerScore();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test setWinner and getWinner method.
     */
    public function testSetAndGetWinner(): void
    {
        $game = new Game();

        $this->expectException(GameException::class);
        $game->setWinner(null);

        $game->setWinner("Player");
        $res = $game->getWinner();
        $exp = "Player";
        $this->assertEquals($exp, $res);

        $game->setWinner("Dealer");
        $res = $game->getWinner();
        $exp = "Dealer";
        $this->assertEquals($exp, $res);
    }

    /**
     * Test reset method.
     */
    public function testReset(): void
    {
        $game = new Game();
        $game->startGame();
        $game->reset();
        $this->assertCount(2, $game->getPlayer()->getHand()->getCards());
        $this->assertCount(1, $game->getDealer()->getHand()->getCards());
        $this->assertCount(48, $game->getDeck()->getCards());
        $this->assertEquals(0, $game->getLastPlayerScore());
        $this->assertEquals(0, $game->getLastDealerScore());
        $this->assertFalse($game->isGameOver());
    }

    /**
     * Test checkDeck method.
     */
    public function testCheckDeck(): void
    {
        $game = new Game();
        $game->startGame();
        $game->checkDeck();
        $this->assertCount(48, $game->getDeck()->getCards());
        $game->getDeck()->draw(48);
        $game->checkDeck();
        $this->assertCount(52, $game->getDeck()->getCards());
    }

    /**
     * Test setDeck method.
     */
    public function testSetDeck(): void
    {
        $game = new Game();
        $game->startGame();
        $this->assertCount(48, $game->getDeck()->getCards());
        $game->setDeck(new DeckOfCards());
        $this->assertCount(52, $game->getDeck()->getCards());
    }

    /**
     * Test jsonSerialize method.
     */
    public function testJsonSerialize(): void
    {
        $game = new Game();
        $game->startGame();
        $game->hit();
        $game->stand();
        $game->newRound();

        $res = $game->jsonSerialize();
        $exp = [
            "playerCards" => $game->getPlayer()->getHand()->getCardsAsArray(),
            "dealerCards" => $game->getDealer()->getHand()->getCardsAsArray(),
            "dealerHiddenCardRevealed" => $game->getDealer()->isHiddenCardRevealed(),
            "playerScore" => $game->getPlayerScore(),
            "dealerScore" => $game->getDealerScore(),
            "lastPlayerScore" => $game->getLastPlayerScore(),
            "lastDealerScore" => $game->getLastDealerScore(),
            "lastWinner" => $game->getWinner()
        ];
        $this->assertEquals($exp, $res);
    }
}