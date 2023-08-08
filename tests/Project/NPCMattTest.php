<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use PHPUnit\Framework\TestCase;

class NPCMattTest extends TestCase
{
    /**
     * Test that the NPCMatt class can be created.
     */
    public function testNPCMatt(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertInstanceOf(
            NPCMatt::class,
            $matt
        );
    }

    /**
     * Test getName
     */
    public function testGetName(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertEquals(
            "Matt",
            $matt->getName()
        );
    }

    /**
     * Test isHuman
     */
    public function testIsHuman(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertEquals(
            false,
            $matt->isHuman()
        );
    }

    /**
     * Test setRole
     */
    public function testSetRole(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $matt->setRole("dealer");

        $this->assertEquals(
            "dealer",
            $matt->getRole()
        );
    }

    /**
     * Test getChips
     */
    public function testGetChips(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertEquals(
            1000,
            $matt->getChips()
        );
    }

    /**
     * Test increaseChips
     */
    public function testIncreaseChips(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $matt->increaseChips(100);

        $this->assertEquals(
            1100,
            $matt->getChips()
        );
    }

    /**
     * Test decreaseChips with not enough chips
     */
    public function testDecreaseChipsWithNotEnoughChips(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $matt->addToBets(1100);
        $matt->decreaseChips(1100);

        $this->assertEquals(
            0,
            $matt->getChips()
        );

        $this->assertEquals(
            1000,
            $matt->getBets()
        );
    }

    /**
     * Test getHand
     */
    public function testGetHand(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertInstanceOf(
            CardHand::class,
            $matt->getHand()
        );
    }

    /**
     * Test setHandValue
     */
    public function testSetHandValue(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $matt->setHandValue(100);

        $this->assertEquals(
            100,
            $matt->getHandValue()
        );
    }

    /**
     * Test setBest5CardHand with Straight Flush
     */
    public function testSetBest5CardHandStraightFlush(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");
        $card4 = new Card("♠", "J");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "KS", "QS", "JS", "TS"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Straight Flush",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Four of a Kind
     */
    public function testSetBest5CardHand4OfAKind(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♣", "A");
        $card3 = new Card("♦", "A");
        $card4 = new Card("♥", "A");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "AC", "AD", "AH"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Four of a Kind",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Full House
     */
    public function testSetBest5CardHandFullHouse(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♣", "A");
        $card3 = new Card("♦", "A");
        $card4 = new Card("♥", "K");
        $card5 = new Card("♠", "K");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "AC", "AD", "KH", "KS"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Full House",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Flush
     */
    public function testSetBest5CardHandFlush(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");
        $card4 = new Card("♠", "J");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "QS", "JS", "TS", "8S"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Flush",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Straight
     */
    public function testSetBest5CardHandStraight(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card7 = new Card("♣", "2");
        $card4 = new Card("♠", "9");
        $card1 = new Card("♠", "Q");
        $card2 = new Card("♠", "J");
        $card3 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card5 = new Card("♣", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["QS", "JS", "TS", "9S", "8C"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Straight",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Three of a Kind
     */
    public function testSetBest5CardHand3OfAKind(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "K");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD", "KH"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Three of a Kind",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Two Pair
     */
    public function testSetBest5CardHand2Pair(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD", "TH", "TS"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Two Pair",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Pair
     */
    public function testSetBest5CardHandPair(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "9");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Pair",
            $matt->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with High Card
     */
    public function testSetBest5CardHandHighCard(): void
    {
        $matt = new NPCMatt("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "Q");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "9");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);
        $matt->getHand()->addCard($card3);
        $matt->getHand()->addCard($card4);
        $matt->getHand()->addCard($card5);
        $matt->getHand()->addCard($card6);
        $matt->getHand()->addCard($card7);

        $matt->setBest5CardHand($matt->getHand());

        $matt->setBest5CardHandArray();

        $this->assertEquals(
            ["KS"],
            $matt->getBest5CardHandArray()
        );

        $this->assertEquals(
            "High Card",
            $matt->getBestHandName()
        );
    }

    /**
     * Test getPlayerData
     */
    public function testGetPlayerData(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $this->assertEquals(
            [
                "name" => "Matt",
                "role" => "",
                "chips" => 1000,
                "bets" => 0,
                "hand" => new CardHand(),
                "playerActions" => "",
                "isHuman" => false,
                'handValue' => 0,
            ],
            $matt->getPlayerData()
        );
    }

    /**
     * Test resetBets
     */
    public function testResetBets(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $matt->addToBets(100);

        $this->assertEquals(
            100,
            $matt->getBets()
        );

        $matt->resetBets();

        $this->assertEquals(
            0,
            $matt->getBets()
        );
    }

    /**
     * Test resetHand
     */
    public function testResetHand(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");

        $matt->getHand()->addCard($card1);
        $matt->getHand()->addCard($card2);

        $this->assertEquals(
            2,
            count($matt->getHand()->getCards())
        );

        $matt->resetHand();

        $this->assertEquals(
            0,
            count($matt->getHand()->getCards())
        );
    }

    /**
     * Test setAndReturnMattMove
     */
    public function testSetAndReturnMattMove(): void
    {
        $matt = new NPCMatt("Matt", 1000);

        $res = $matt->setAndReturnMattMove(3, 100, 20);

        $this->assertIsArray($res);
    }
}
