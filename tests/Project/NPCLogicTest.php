<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use PHPUnit\Framework\TestCase;

class NPCLogicTest extends TestCase
{
    /**
     * Test isRunningLowOnChips().
     */
    public function testIsRunningLowOnChips()
    {
        $npcLogic = new NPCLogic();
        $player = new ProjectPlayer("Test", 1000);
        $this->assertEquals(false, $npcLogic->isRunningLowOnChips($player, 1000));

        $player = new ProjectPlayer("Test", 249);
        $this->assertEquals(true, $npcLogic->isRunningLowOnChips($player, 1000));
    }

    /**
     * Test getStartingCardValue().
     */
    public function testGetStartingCardValue()
    {
        $npcLogic = new NPCLogic();
        $card1 = new Card("♥", "A");
        $card2 = new Card("♠", "K");
        $cards = [$card1, $card2];
        $this->assertEquals("AK", $npcLogic->getStartingCardValue($cards));

        $card1 = new Card("♥", "Q");
        $card2 = new Card("♠", "10");
        $cards = [$card1, $card2];
        $this->assertEquals("QT", $npcLogic->getStartingCardValue($cards));

        $card1 = new Card("♥", "J");
        $card2 = new Card("♠", "10");
        $cards = [$card1, $card2];
        $this->assertEquals("JT", $npcLogic->getStartingCardValue($cards));
    }

    /**
     * Test getStartingCardType().
     */
    public function testGetStartingCardType()
    {
        $npcLogic = new NPCLogic();
        $card1 = new Card("♥", "A");
        $card2 = new Card("♠", "K");
        $cards = [$card1, $card2];
        $this->assertEquals("o", $npcLogic->getStartingCardType($cards));

        $card1 = new Card("♠", "Q");
        $card2 = new Card("♠", "10");
        $cards = [$card1, $card2];
        $this->assertEquals("s", $npcLogic->getStartingCardType($cards));

        $card1 = new Card("♥", "J");
        $card2 = new Card("♠", "J");
        $cards = [$card1, $card2];
        $this->assertEquals("p", $npcLogic->getStartingCardType($cards));
    }

    /**
     * Test adjustCardRiskRank().
     */
    public function testAdjustCardRiskRank()
    {
        $npcLogic = new NPCLogic();
        $this->assertEquals(50, $npcLogic->adjustCardRiskRank(20));
        $this->assertEquals(40, $npcLogic->adjustCardRiskRank(50));
        $this->assertEquals(30, $npcLogic->adjustCardRiskRank(100));
        $this->assertEquals(10, $npcLogic->adjustCardRiskRank(101));
    }

    /**
     * Test hasPlayerRaised().
     */
    public function testHasPlayerRaised()
    {
        $npcLogic = new NPCLogic();
        $actions = ["fold", "call", "raise"];
        $this->assertEquals(true, $npcLogic->hasPlayerRaised($actions));

        $actions = ["fold", "call", "call"];
        $this->assertEquals(false, $npcLogic->hasPlayerRaised($actions));
    }

    /**
     * Test hasPlayerCalled().
     */
    public function testHasPlayerCalled()
    {
        $npcLogic = new NPCLogic();
        $actions = ["fold", "call", "raise"];
        $this->assertEquals(true, $npcLogic->hasPlayerCalled($actions));

        $actions = ["fold", "fold", "fold"];
        $this->assertEquals(false, $npcLogic->hasPlayerCalled($actions));
    }

    /**
     * Test hasPlayerChecked().
     */
    public function testHasPlayerChecked()
    {
        $npcLogic = new NPCLogic();
        $actions = ["fold", "call", "raise"];
        $this->assertEquals(false, $npcLogic->hasPlayerChecked($actions));

        $actions = ["check", "fold", "fold"];
        $this->assertEquals(true, $npcLogic->hasPlayerChecked($actions));
    }

    /**
     * Test adjustRiskPlayerActions().
     */
    public function testAdjustRiskPlayerActions()
    {
        $npcLogic = new NPCLogic();
        $actions = ["fold", "call", "raise"];
        $this->assertEquals(20, $npcLogic->adjustRiskPlayerActions($actions));

        $actions = ["fold", "fold", "fold"];
        $this->assertEquals(0, $npcLogic->adjustRiskPlayerActions($actions));

        $actions = ["check", "fold", "fold"];
        $this->assertEquals(30, $npcLogic->adjustRiskPlayerActions($actions));

        $actions = ["check", "call", "fold"];
        $this->assertEquals(80, $npcLogic->adjustRiskPlayerActions($actions));

        $actions = ["check", "call", "raise"];
        $this->assertEquals(-30, $npcLogic->adjustRiskPlayerActions($actions));

        $actions = ["raise"];
        $this->assertEquals(-20, $npcLogic->adjustRiskPlayerActions($actions));
    }

    /**
     * Test adjustRiskPotAndBlind().
     */
    public function testAdjustRiskPotAndBlind()
    {
        $npcLogic = new NPCLogic();
        $this->assertEquals(50, $npcLogic->adjustRiskPotAndBlind(100, 10));
        $this->assertEquals(0, $npcLogic->adjustRiskPotAndBlind(10, 5));
        $this->assertEquals(10, $npcLogic->adjustRiskPotAndBlind(1000, 200));
    }

    /**
     * Test adjustHandRiskPoints().
     */
    public function testAdjustHandRiskPoints()
    {
        $npcLogic = new NPCLogic();
        $this->assertEquals(50, $npcLogic->adjustHandRiskPoints(500));
        $this->assertEquals(30, $npcLogic->adjustHandRiskPoints(350));
        $this->assertEquals(10, $npcLogic->adjustHandRiskPoints(100));
    }

    /**
     * Test wrapperMattChecks().
     */
    public function testWrapperMattChecks()
    {
        $npcLogic = new NPCLogic();
        $player = new ProjectPlayer("Test", 1000);
        $this->assertEquals(["check", ""], $npcLogic->wrapperMattChecks($npcLogic, $player, 100, 10));
    }

    /**
     * Test wrapperMattCalls().
     */
    public function testWrapperMattCalls()
    {
        $npcLogic = new NPCLogic();
        $player = new ProjectPlayer("Test", 1000);
        $this->assertEquals(["call", 10], $npcLogic->wrapperMattCalls($npcLogic, $player, 10));
    }

    /**
     * Test wrapperMattRaises().
     */
    public function testWrapperMattRaises()
    {
        $npcLogic = new NPCLogic();
        $player = new ProjectPlayer("Test", 1000);
        $this->assertEquals(["raise", 100], $npcLogic->wrapperMattRaises($npcLogic, $player, 100, 10));
    }

    /**
     * Test setMattFolds().
     */
    public function testSetMattFolds()
    {
        $npcLogic = new NPCLogic();
        $player = new ProjectPlayer("Test", 1000);
        $this->assertEquals(["fold", ""], $npcLogic->wrapperMattFolds($npcLogic, $player));
    }

}