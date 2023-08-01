<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\Cards\Card;
use App\Cards\CardHand;

class PlayerTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        // Arrange
        $player = new Player("player");

        // Assert
        $this->assertInstanceOf(Player::class, $player);
        $this->assertEquals("player", $player->getName());
    }

    /**
     * Test setBet method.
     */
    public function testSetBet(): void
    {
        $player = new Player("player");
        $player->setBet(100);
        $res = $player->getBet();
        $exp = 100;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test setChips method.
     */
    public function testSetChips(): void
    {
        $player = new Player("player");
        $player->setChips(100);
        $res = $player->getChips();
        $exp = 100;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test addChips method.
     */
    public function testAddChips(): void
    {
        $player = new Player("player");
        $player->setChips(100);
        $player->addChips(100);
        $res = $player->getChips();
        $exp = 200;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test playerDraw method.
     */
    public function testPlayerDraw(): void
    {
        $player = new Player("player");
        $card = new Card('♥', '7');
        $player->playerDraw($card);
        $res = $player->getHand()->getCards();
        $exp = [$card];
        $this->assertEquals($exp, $res);
    }

    /**
     * Test playerBets method.
     */
    public function testPlayerBets(): void
    {
        $player = new Player("player");
        $player->setChips(100);
        $player->playerBets(120);
        $res = $player->getChips();
        $exp = 0;
        $this->assertEquals($exp, $res);
        $res = $player->getBet();
        $exp = 100;
        $this->assertEquals($exp, $res);
        $res = $player->getAllIn();
        $exp = true;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test playerReset method.
     */
    public function testPlayerReset(): void
    {
        $player = new Player("player");
        $card = new Card('♥', '7');
        $player->playerDraw($card);
        $player->setBet(100);
        $player->setDealer(true);

        $res = $player->getDealer();
        $exp = true;
        $this->assertEquals($exp, $res);

        $res = $player->getFolded();
        $exp = false;
        $this->assertEquals($exp, $res);

        $player->setFolded();
        $res = $player->getFolded();
        $exp = true;
        $this->assertEquals($exp, $res);

        $player->playerReset();

        $res = $player->getHand()->getCards();
        $res = count($res);
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $player->getBet();
        $exp = 0;
        $this->assertEquals($exp, $res);

        $res = $player->getDealer();
        $exp = false;
        $this->assertEquals($exp, $res);

        $res = $player->getAllIn();
        $exp = false;
        $this->assertEquals($exp, $res);

        $res = $player->getBigBlind();
        $exp = true;
        $this->assertEquals($exp, $res);

        $player->playerReset();
        $res = $player->getBigBlind();
        $exp = false;
        $this->assertEquals($exp, $res);

        $res = $player->getSmallBlind();
        $exp = true;
        $this->assertEquals($exp, $res);

        $player->playerReset();

        $res = $player->getSmallBlind();
        $exp = false;
        $this->assertEquals($exp, $res);

        $player->setAllIn();
        $player->setBigBlind();
        $player->setSmallBlind();
        $exp = true;
        $this->assertEquals($exp, $player->getAllIn());
        $this->assertEquals($exp, $player->getBigBlind());
        $this->assertEquals($exp, $player->getSmallBlind());
    }

    /**
     * Test toJson method.
     */
    public function testToJson(): void
    {
        $player = new Player("player");
        $card = new Card('♥', '7');
        $player->playerDraw($card);
        $player->setBet(100);
        $player->setDealer(true);
        $player->setFolded();
        $player->setAllIn();
        $player->setBigBlind();
        $player->setSmallBlind();

        $res = $player->toJson();
        $exp = [
            "name" => "player",
            "hand" => [$card->toJson(),],
            "bet" => 100,
            "chips" => 1000,
            "folded" => true,
            "dealer" => true,
            "bigBlind" => true,
            "smallBlind" => true,
            "allIn" => true
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Test fromJson method.
     */
    public function testFromJson(): void
    {
        $player = new Player("player");
        $card = new Card('♥', '7');
        $player->playerDraw($card);
        $player->setBet(100);
        $player->setDealer(true);
        $player->setFolded();
        $player->setAllIn();
        $player->setBigBlind();
        $player->setSmallBlind();

        $res = $player->toJson();
        $exp = [
            "name" => "player",
            "hand" => [$card->toJson(),],
            "bet" => 100,
            "chips" => 1000,
            "folded" => true,
            "dealer" => true,
            "bigBlind" => true,
            "smallBlind" => true,
            "allIn" => true
        ];
        $this->assertEquals($exp, $res);

        $player2 = new Player("player2");
        $player2->fromJson($res);

        $res = $player2->toJson();
        $exp = [
            "name" => "player",
            "hand" => [$card->toJson(),],
            "bet" => 100,
            "chips" => 1000,
            "folded" => true,
            "dealer" => true,
            "bigBlind" => true,
            "smallBlind" => true,
            "allIn" => true
        ];
        $this->assertEquals($exp, $res);
    }

    /**
     * Test __toString method.
     */
    public function testToString(): void
    {
        $player = new Player("player");
        $card = new Card('♥', '7');
        $player->playerDraw($card);
        $player->setBet(100);

        $res = $player->__toString();
        $exp = json_encode([
            "name" => "player",
            "hand" => [$card->toJson(),],
            "bet" => 100,
            "chips" => 1000,
            "folded" => false,
            "dealer" => false,
            "bigBlind" => false,
            "smallBlind" => false,
            "allIn" => false
        ]);
        $this->assertEquals($exp, $res);
    }
}