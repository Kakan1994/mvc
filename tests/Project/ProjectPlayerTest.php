<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use PHPUnit\Framework\TestCase;

class ProjectPlayerTest extends TestCase
{
    /**
     * Test getName() method.
     */
    public function testGetName(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertEquals(
            "Matt",
            $player->getName()
        );
    }

    /**
     * Test setRole() method.
     */
    public function testSetRole(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->setRole("Dealer");

        $this->assertEquals(
            "Dealer",
            $player->getRole()
        );
    }

    /**
     * Test getChips() method.
     */
    public function testGetChips(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertEquals(
            1000,
            $player->getChips()
        );
    }

    /**
     * Test increaseChips() method.
     */
    public function testIncreaseChips(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->increaseChips(1000);

        $this->assertEquals(
            2000,
            $player->getChips()
        );
    }

    /**
     * Test decreaseChips() method.
     */
    public function testDecreaseChips(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->decreaseChips(1200);

        $this->assertEquals(
            000,
            $player->getChips()
        );
    }

    /**
     * Test getBets() method.
     */
    public function testGetBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertEquals(
            0,
            $player->getBets()
        );
    }

    /**
     * Test setBets() method.
     */
    public function testSetBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->setBets(1000);

        $this->assertEquals(
            1000,
            $player->getBets()
        );
    }

    /**
     * Test resetBets() method.
     */
    public function testResetBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->setBets(1000);
        $player->resetBets();

        $this->assertEquals(
            0,
            $player->getBets()
        );
    }

    /**
     * Test addToBets() method.
     */
    public function testAddToBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->addToBets(1200);

        $this->assertEquals(
            1000,
            $player->getBets()
        );
    }

    /**
     * Test clearPlayerBets() method.
     */
    public function testClearPlayerBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->addToBets(1200);
        $player->clearPlayerBets();

        $this->assertEquals(
            0,
            $player->getBets()
        );
    }

    /**
     * Test getTotalBets() method.
     */
    public function testGetTotalBets(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $player->addToBets(1200);
        $player->clearPlayerBets();

        $this->assertEquals(
            1000,
            $player->getTotalBets()
        );
    }

    /**
     * Test getHand() method.
     */
    public function testGetHand(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertInstanceOf(
            CardHand::class,
            $player->getHand()
        );
    }

    /**
     * Test setHand() method.
     */
    public function testSetHand(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $hand = new CardHand();
        $hand->addCard($card);

        $player->setHand($hand);

        $res = $player->getHand()->getCards()[0];
        $exp = $card;
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test getPlayerActions() method.
     */
    public function testGetPlayerActions(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertInstanceOf(
            PlayerActions::class,
            $player->getPlayerActions()
        );
    }

    /**
     * Test getHandValue() method.
     */
    public function testGetHandValue(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        
        $player->setHandValue(11);

        $this->assertEquals(
            11,
            $player->getHandValue()
        );
    }

    /**
     * Test getString() method.
     */
    public function testGetString(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $card2 = new Card("♠", "2");
        $hand = new CardHand();
        $hand->addCard($card);
        $hand->addCard($card2);

        $player->setHand($hand);

        $res = $player->getString();
        $exp = ["AS", "2S"];
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test isHuman() method.
     */
    public function testIsHuman(): void
    {
        $player = new ProjectPlayer("Matt", 1000);

        $this->assertTrue(
            $player->isHuman()
        );
    }

    /**
     * Test setBest5CardHand() method.
     */
    public function testSetBest5CardHand(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $card2 = new Card("♠", "2");
        $hand = new CardHand();
        $hand->addCard($card);
        $hand->addCard($card2);

        $player->setBest5CardHand($hand);
        $player->SetBest5CardHandArray();

        $res = $player->getBest5CardHandArray();
        $exp = ["AS"];
        $this->assertEquals(
            $exp,
            $res
        );
    }

    /**
     * Test setBest5CardHand with Straight Flush
     */
    public function testSetBest5CardHandStraightFlush(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");
        $card4 = new Card("♠", "J");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "KS", "QS", "JS", "TS"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Straight Flush",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Four of a Kind
     */
    public function testSetBest5CardHand4OfAKind(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♣", "A");
        $card3 = new Card("♦", "A");
        $card4 = new Card("♥", "A");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "AC", "AD", "AH"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Four of a Kind",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Full House
     */
    public function testSetBest5CardHandFullHouse(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♠", "A");
        $card2 = new Card("♣", "A");
        $card3 = new Card("♦", "A");
        $card4 = new Card("♥", "K");
        $card5 = new Card("♠", "K");
        $card6 = new Card("♠", "9");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["AS", "AC", "AD", "KH", "KS"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Full House",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Flush
     */
    public function testSetBest5CardHandFlush(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♠", "Q");
        $card4 = new Card("♠", "J");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "QS", "JS", "TS", "8S"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Flush",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Straight
     */
    public function testSetBest5CardHandStraight(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card7 = new Card("♣", "2");
        $card4 = new Card("♠", "9");
        $card1 = new Card("♠", "Q");
        $card2 = new Card("♠", "J");
        $card3 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card5 = new Card("♣", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["QS", "JS", "TS", "9S", "8C"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Straight",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Three of a Kind
     */
    public function testSetBest5CardHand3OfAKind(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "K");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD", "KH"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Three of a Kind",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Two Pair
     */
    public function testSetBest5CardHand2Pair(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "10");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD", "TH", "TS"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Two Pair",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with Pair
     */
    public function testSetBest5CardHandPair(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "K");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "9");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["KS", "KD"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "Pair",
            $player->getBestHandName()
        );
    }

    /**
     * Test setBest5CardHand with High Card
     */
    public function testSetBest5CardHandHighCard(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card1 = new Card("♣", "2");
        $card2 = new Card("♠", "K");
        $card3 = new Card("♦", "Q");
        $card4 = new Card("♥", "10");
        $card5 = new Card("♠", "9");
        $card6 = new Card("♣", "4");
        $card7 = new Card("♠", "8");

        $player->getHand()->addCard($card1);
        $player->getHand()->addCard($card2);
        $player->getHand()->addCard($card3);
        $player->getHand()->addCard($card4);
        $player->getHand()->addCard($card5);
        $player->getHand()->addCard($card6);
        $player->getHand()->addCard($card7);

        $player->setBest5CardHand($player->getHand());

        $player->setBest5CardHandArray();

        $this->assertEquals(
            ["KS"],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "High Card",
            $player->getBestHandName()
        );
    }

    /**
     * Test resetBest5CardHand() method.
     */
    public function testResetBest5CardHand(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $card2 = new Card("♠", "2");
        $hand = new CardHand();
        $hand->addCard($card);
        $hand->addCard($card2);

        $player->setBest5CardHand($hand);
        $player->SetBest5CardHandArray();

        $player->resetBest5CardHand();

        $this->assertEquals(
            [],
            $player->getBest5CardHandArray()
        );

        $this->assertEquals(
            "",
            $player->getBestHandName()
        );
    }

    /**
     * Test resetHand() method.
     */
    public function testResetHand(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $card2 = new Card("♠", "2");
        $hand = new CardHand();
        $hand->addCard($card);
        $hand->addCard($card2);

        $player->setHand($hand);

        $player->resetHand();

        $this->assertEquals(
            [],
            $player->getHand()->getCards()
        );
    }

    /**
     * Test getPlayerData() method.
     */
    public function testGetPlayerData(): void
    {
        $player = new ProjectPlayer("Matt", 1000);
        $card = new Card("♠", "A");
        $card2 = new Card("♠", "2");
        $hand = new CardHand();
        $hand->addCard($card);
        $hand->addCard($card2);

        $player->setHand($hand);

        $res = $player->getPlayerData();
        $exp = [
            "name" => "Matt",
            "role" => "",
            "chips" => 1000,
            "folded" => false,
            "bets" => 0,
            "totalBets" => 0,
            "hand" => $hand,
            "playerActions" => '',
            "isHuman" => true,
            "handValue" => 0,
        ];
        $this->assertEquals(
            $exp,
            $res
        );
    }
}
