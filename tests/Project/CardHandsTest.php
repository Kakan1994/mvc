<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;
use App\Cards\Card;
use App\Cards\CardHand;

class CardHandsTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $cardHands = new CardHands();
        $this->assertInstanceOf("\App\Project\CardHands", $cardHands);
    }

    /**
     * Test checkHighCardAceHigh
     */
    public function testCheckHighCardAceHigh(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', '7'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', 'A'));

        $cardHands = new CardHands();
        $res = $cardHands->checkHighCardAceHigh($cardHand);
        $exp = new Card('♥', 'A');
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkPair method 2 card hand.
     */
    public function testCheckPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));

        $cardHands = new CardHands();
        $res = $cardHands->checkPair($cardHand);
        $cards = [new Card('♥', 'A'), new Card('♠', 'A')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkPair method 7 card hand.
     */
    public function testCheckPair7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkPair($cardHand);
        $cards = [new Card('♥', 'K'), new Card('♠', 'K')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkPair method 7 card hand with queens and < 10.
     */
    public function testCheckPair7Queens(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'Q'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♦', '4'));
        $cardHand->addCard(new Card('♣', '5'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkPair($cardHand);
        $cards = [new Card('♥', 'Q'), new Card('♠', 'Q')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }
    
    /**
     * Test checkPair method 7 card with no pairs.
     */
    public function testCheckPair7NoPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', '10'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkPair($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkPair method with J.
     */
    public function testCheckPairJ(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'J'));
        $cardHand->addCard(new Card('♠', 'J'));

        $cardHands = new CardHands();
        $res = $cardHands->checkPair($cardHand);
        $cards = [new Card('♥', 'J'), new Card('♠', 'J')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test check2Pair method with 7 card hand.
     */
    public function testCheck2Pair7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->check2Pair($cardHand);
        $cards = [new Card('♥', 'K'), new Card('♠', 'K'), new Card('♦', 'J'), new Card('♣', 'J')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test check2Pair method with 7 card hand with only 1 pair.
     */
    public function testCheck2Pair7OnePair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', '10'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->check2Pair($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test check2Pair method with 7 card hand with no pairs.
     */
    public function testCheck2Pair7NoPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', '10'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->check2Pair($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkHighCardAceLow method with 5 card hand straight.
     */
    public function testCheckHighCardAceLow5Straight(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', '2'));
        $cardHand->addCard(new Card('♦', '3'));
        $cardHand->addCard(new Card('♣', '4'));
        $cardHand->addCard(new Card('♥', '5'));

        $cardHands = new CardHands();
        $res = $cardHands->checkHighCardAceLow($cardHand);
        $exp = new Card('♥', '5');
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkHighCardAceLow method with 7 card hand straight.
     */
    public function testCheckHighCardAceLow7Straight(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', '2'));
        $cardHand->addCard(new Card('♦', '3'));
        $cardHand->addCard(new Card('♣', '4'));
        $cardHand->addCard(new Card('♥', '5'));
        $cardHand->addCard(new Card('♠', '6'));
        $cardHand->addCard(new Card('♦', '7'));

        $cardHands = new CardHands();
        $res = $cardHands->checkHighCardAceLow($cardHand);
        $exp = new Card('♦', '7');
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkThreeOfAKind method with 7 card hand.
     */
    public function testCheckThreeOfAKind7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'K'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkThreeOfAKind($cardHand);
        $cards = [new Card('♥', 'K'), new Card('♠', 'K'), new Card('♦', 'K')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkThreeOfAKind method with 7 card hand with only 2 of a kind.
     */
    public function testCheckThreeOfAKind7TwoOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', 'Q'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkThreeOfAKind($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkThreeOfAKind method with 7 card hand with only 2 pair.
     */
    public function testCheckThreeOfAKind7TwoPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkThreeOfAKind($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkThreeOfAKind method with 7 card hand with no pairs.
     */
    public function testCheckThreeOfAKind7NoPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'J'));
        $cardHand->addCard(new Card('♣', '10'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkThreeOfAKind($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkStraight method with 3 card hand.
     */
    public function testCheckStraight3(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', '2'));
        $cardHand->addCard(new Card('♦', '3'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraight($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkStraight method with many diffrent hands with straights.
     */
    public function testCheckStraight7ManyStraights(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));
        $cardHand->addCard(new Card('♥', '5'));
        $cardHand->addCard(new Card('♥', '6'));
        $cardHand->addCard(new Card('♥', '7'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraight($cardHand);
        $res = $res->getCardsAsArray();
        $exp = new CardHand();
        $exp->addCard(new Card('♥', '3'));
        $exp->addCard(new Card('♥', '4'));
        $exp->addCard(new Card('♥', '5'));
        $exp->addCard(new Card('♥', '6'));
        $exp->addCard(new Card('♥', '7'));
        $exp = $exp->getCardsAsArray();
        $this->assertEquals($exp, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));
        $cardHand->addCard(new Card('♥', '5'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraight($cardHand);
        $res = $res->getCardsAsArray();
        $exp = new CardHand();
        $exp->addCard(new Card('♥', 'A'));
        $exp->addCard(new Card('♥', '2'));
        $exp->addCard(new Card('♥', '3'));
        $exp->addCard(new Card('♥', '4'));
        $exp->addCard(new Card('♥', '5'));
        $exp = $exp->getCardsAsArray();
        $this->assertEquals($exp, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♥', 'Q'));
        $cardHand->addCard(new Card('♥', 'J'));
        $cardHand->addCard(new Card('♥', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraight($cardHand);
        $res = $res->getCardsAsArray();
        rsort($res);
        $exp = new CardHand();
        $exp->addCard(new Card('♥', '10'));
        $exp->addCard(new Card('♥', 'J'));
        $exp->addCard(new Card('♥', 'Q'));
        $exp->addCard(new Card('♥', 'K'));
        $exp->addCard(new Card('♥', 'A'));
        $exp = $exp->getCardsAsArray();
        rsort($exp);
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkStraight method with 7 card hand with no straight.
     */
    public function testCheckStraight7NoStraight(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♥', 'Q'));
        $cardHand->addCard(new Card('♦', 'Q'));
        $cardHand->addCard(new Card('♥', '10'));
        $cardHand->addCard(new Card('♥', '9'));
        $cardHand->addCard(new Card('♥', '8'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraight($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkfourOfAKind method with 7 card hand.
     */
    public function testCheckFourOfAKind7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♣', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFourOfAKind($cardHand);
        $cards = [new Card('♥', 'A'), new Card('♠', 'A'), new Card('♦', 'A'), new Card('♣', 'A')];
        $exp = new CardHand();
        foreach ($cards as $card) {
            $exp->addCard($card);
        }
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkFourOfAKind method with 7 card hand with only 3 of a kind.
     */
    public function testCheckFourOfAKind7ThreeOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFourOfAKind($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Check checkFlush method.
     */
    public function testCheckFlush7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));
        $cardHand->addCard(new Card('♥', '5'));
        $cardHand->addCard(new Card('♥', '6'));
        $cardHand->addCard(new Card('♥', '7'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFlush($cardHand);
        $exp = [new Card('♥', 'A'), new Card('♥', '2'), new Card('♥', '3'), new Card('♥', '4'), new Card('♥', '5'), new Card('♥', '6'), new Card('♥', '7')];
        $expCardHand = new CardHand();
        foreach ($exp as $card) {
            $expCardHand->addCard($card);
        }
        $this->assertEquals($expCardHand, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));
        $cardHand->addCard(new Card('♥', '5'));
        $cardHand->addCard(new Card('♥', '6'));
        $cardHand->addCard(new Card('♥', '7'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFlush($cardHand);
        $exp = [new Card('♥', '2'), new Card('♥', '3'), new Card('♥', '4'), new Card('♥', '5'), new Card('♥', '6'), new Card('♥', '7')];
        $expCardHand = new CardHand();
        foreach ($exp as $card) {
            $expCardHand->addCard($card);
        }
        $this->assertEquals($expCardHand, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFlush($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', '2'));
        $cardHand->addCard(new Card('♥', '3'));
        $cardHand->addCard(new Card('♥', '4'));
        $cardHand->addCard(new Card('♥', '5'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFlush($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkFullHouse method with 7 card hand.
     */
    public function testCheckFullHouse7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♦', 'J'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFullHouse($cardHand);
        $exp = ["♦A", "♥A", "♠A", "♣K", "♥K"];
        $res = $res->getCardsAsArray();
        rsort($res);
        rsort($exp);
        $this->assertEquals($exp, $res);
        $this->assertEquals(5, count($res));
    }

    /**
     * Test checkFullHouse method with 7 card hand with only 3 of a kind.
     */
    public function testCheckFullHouse7ThreeOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♥', '10'));
        $cardHand->addCard(new Card('♠', 'J'));
        $cardHand->addCard(new Card('♦', 'Q'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFullHouse($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkFullHouse method with 3 card hand.
     */
    public function testCheckFullHouse3(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', 'A'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFullHouse($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkFullHouse method with 7 card hand with only a pair.
     */
    public function testCheckFullHouse7Pair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♠', '7'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♥', '10'));
        $cardHand->addCard(new Card('♠', 'J'));
        $cardHand->addCard(new Card('♦', 'Q'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFullHouse($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkFullHouse method with 7 card hand and two 3 of a kind.
     */
    public function testCheckFullHouse7TwoThreeOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));

        $cardHands = new CardHands();
        $res = $cardHands->checkFullHouse($cardHand);
        $exp = new CardHand();
        $exp->addCard(new Card('♠', 'A'));
        $exp->addCard(new Card('♠', 'A'));
        $exp->addCard(new Card('♠', 'A'));
        $exp->addCard(new Card('♠', 'K'));
        $exp->addCard(new Card('♠', 'K'));
        $exp = $exp->getCardsAsArray();
        $res = $res->getCardsAsArray();
        rsort($exp);
        rsort($res);
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkStraightFlush method with 7 card hand.
     */
    public function testCheckStraightFlush7(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♠', '4'));
        $cardHand->addCard(new Card('♠', '5'));
        $cardHand->addCard(new Card('♠', '6'));
        $cardHand->addCard(new Card('♠', '7'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraightFlush($cardHand);
        $exp = [new Card('♠', '3'), new Card('♠', '4'), new Card('♠', '5'), new Card('♠', '6'), new Card('♠', '7')];
        $expCardHand = new CardHand();
        foreach ($exp as $card) {
            $expCardHand->addCard($card);
        }
        $this->assertEquals($expCardHand, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', '2'));
        $cardHand->addCard(new Card('♠', '3'));
        $cardHand->addCard(new Card('♦', '4'));
        $cardHand->addCard(new Card('♠', '5'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraightFlush($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♠', 'J'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraightFlush($cardHand);
        $exp = [new Card('♠', 'A'), new Card('♠', 'K'), new Card('♠', 'Q'), new Card('♠', 'J'), new Card('♠', '10')];
        $expCardHand = new CardHand();
        foreach ($exp as $card) {
            $expCardHand->addCard($card);
        }
        $this->assertEquals($expCardHand, $res);

        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraightFlush($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Straight Flush.
     */
    public function testCheckBestHandStraightFlush(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♠', 'J'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 9;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Four of a kind.
     */
    public function testCheckBestHandFourOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♣', 'A'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 8;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Full House.
     */
    public function testCheckBestHandFullHouse(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♠', 'K'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 7;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Flush.
     */
    public function testCheckBestHandFlush(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♠', 'Q'));
        $cardHand->addCard(new Card('♠', 'J'));
        $cardHand->addCard(new Card('♠', '9'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 6;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Straight.
     */
    public function testCheckBestHandStraight(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'K'));
        $cardHand->addCard(new Card('♥', 'Q'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 5;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Three of a kind.
     */

    public function testCheckBestHandThreeOfAKind(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'A'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 4;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Two pair.
     */
    public function testCheckBestHandTwoPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'A'));
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♣', 'K'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 3;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method Pair.
     */

    public function testCheckBestHandPair(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', '5'));
        $cardHand->addCard(new Card('♥', 'K'));
        $cardHand->addCard(new Card('♣', '5'));
        $cardHand->addCard(new Card('♠', '10'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 2;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkBestHand method High card.
     */
    public function testCheckBestHandHighCard(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'K'));
        $cardHand->addCard(new Card('♦', 'Q'));
        $cardHand->addCard(new Card('♥', 'J'));
        $cardHand->addCard(new Card('♣', '8'));
        $cardHand->addCard(new Card('♠', '9'));

        $cardHands = new CardHands();
        $res = $cardHands->checkBestHand($cardHand);
        $exp = 1;
        $this->assertEquals($exp, $res);
    }

    /**
     * Test checkStraightFlush method with 7 card hand with no straight flush.
     */
    public function testCheckStraightFlush7NoStraightFlush(): void
    {
        $cardHand = new CardHand();
        $cardHand->addCard(new Card('♠', 'A'));
        $cardHand->addCard(new Card('♦', 'K'));
        $cardHand->addCard(new Card('♥', 'Q'));
        $cardHand->addCard(new Card('♣', 'J'));
        $cardHand->addCard(new Card('♠', '10'));
        $cardHand->addCard(new Card('♠', '9'));
        $cardHand->addCard(new Card('♠', '8'));

        $cardHands = new CardHands();
        $res = $cardHands->checkStraightFlush($cardHand);
        $exp = new CardHand();
        $this->assertEquals($exp, $res);
    }
}