<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class NPCSteveTest extends TestCase
{
    /**
     * Test that the NPCSteve class can be created.
     */
    public function testNPCSteve(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $this->assertInstanceOf(
            NPCSteve::class,
            $steve
        );
    }

    /**
     * Test getRiskLevel
     */
    public function testGetRiskLevel(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $this->assertEquals(
            0,
            $steve->getRiskLevel()
        );
    }

    /**
     * Test changeRiskLevel
     */
    public function testChangeRiskLevel(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->changeRiskLevel(10);

        $this->assertEquals(
            10,
            $steve->getRiskLevel()
        );
    }

    /**
     * Test clearRiskLevel
     */
    public function testClearRiskLevel(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->changeRiskLevel(10);

        $this->assertEquals(
            10,
            $steve->getRiskLevel()
        );

        $steve->clearRiskLevel();

        $this->assertEquals(
            0,
            $steve->getRiskLevel()
        );
    }

    /**
     * Test setSteveFold
     */
    public function testSetSteveFold(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveFold();

        $this->assertEquals(
            0,
            $steve->getBets()
        );

        $this->assertEquals(
            true,
            $steve->getPlayerActions()->hasFolded()
        );

        $this->assertEquals(
            ["fold"],
            $steve->getPlayerActions()->getRoundActions()
        );
    }

    /**
     * Test setSteveCheck
     */
    public function testSetSteveCheck(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveCheck();

        $this->assertEquals(
            ["check"],
            $steve->getPlayerActions()->getRoundActions()
        );
    }

    /**
     * Test setSteveCall
     */
    public function testSetSteveCall(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveCall(100);

        $this->assertEquals(
            100,
            $steve->getBets()
        );

        $this->assertEquals(
            ["call"],
            $steve->getPlayerActions()->getRoundActions()
        );
    }

    /**
     * Test setSteveRaise
     */
    public function testSetSteveRaise(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveRaise(100);

        $this->assertEquals(
            100,
            $steve->getBets()
        );

        $this->assertEquals(
            ["raise"],
            $steve->getPlayerActions()->getRoundActions()
        );
    }

    /**
     * Test setSteveActionAndReturnData with fold
     */
    public function testSetSteveActionAndReturnDataWithFold(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveActionAndReturnData("fold", 100, 20);

        $this->assertEquals(
            0,
            $steve->getBets()
        );
    }

    /**
     * Test setSteveActionAndReturnData with check
     */
    public function testSetSteveActionAndReturnDataWithCheck(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveActionAndReturnData("check", 100, 20);

        $this->assertEquals(
            0,
            $steve->getBets()
        );
    }

    /**
     * Test setSteveActionAndReturnData with call
     */

    public function testSetSteveActionAndReturnDataWithCall(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveActionAndReturnData("call", 100, 20);

        $this->assertEquals(
            100,
            $steve->getBets()
        );
    }

    /**
     * Test setSteveActionAndReturnData with raise
     */
    public function testSetSteveActionAndReturnDataWithRaise(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveActionAndReturnData("raise", 100, 20);

        $this->assertEquals(
            120,
            $steve->getBets()
        );
    }

    /**
     * Test setSteveActionAndReturnData with no action
     */
    public function testSetSteveActionAndReturnDataWithNoAction(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $steve->setSteveActionAndReturnData("", 100, 20);

        $this->assertEquals(
            0,
            $steve->getBets()
        );
    }

    /**
     * Test setSteveActionPost
     */
    
    public function testSetSteveActionPost(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $action = $steve->setSteveActionPost(100, 3);

        $this->assertEquals(
            "call",
            $action
        );

        $action = $steve->setSteveActionPost(120, 3);

        $this->assertEquals(
            "raise",
            $action
        );

        $action = $steve->setSteveActionPost(30, 3);

        $this->assertEquals(
            "fold",
            $action
        );

        $action = $steve->setSteveActionPost(0, 2);

        $this->assertEquals(
            "check",
            $action
        );

        $action = $steve->setSteveActionPost(100, 2);

        $this->assertEquals(
            "raise",
            $action
        );
    }

    /**
     * Test setSteveActionPre
     */
    public function testSetSteveActionPre(): void
    {
        $steve = new NPCSteve("Steve", 1000);

        $action = $steve->setSteveActionPre(60, 3);

        $this->assertEquals(
            "call",
            $action
        );

        $action = $steve->setSteveActionPre(600, 3);

        $this->assertEquals(
            "raise",
            $action
        );

        $action = $steve->setSteveActionPre(20, 3);

        $this->assertEquals(
            "fold",
            $action
        );

        $action = $steve->setSteveActionPre(0, 2);

        $this->assertEquals(
            "check",
            $action
        );

        $action = $steve->setSteveActionPre(100, 2);

        $this->assertEquals(
            "raise",
            $action
        );
    }

    /**
     * Test setSteveRisk
     */
    public function testSetSteveRisk(): void
    {
        $steve = new NPCSteve("Steve", 1000);
        $human = new ProjectPlayer("Player", 1000);

        $steve->setSteveRisk($human, "pre", 100, 20);

        $this->assertEquals(
            50,
            $steve->getRiskLevel()
        );

        $steve->setSteveRisk($human, "post", 100, 20);

        $this->assertEquals(
            100,
            $steve->getRiskLevel()
        );
    }
}
