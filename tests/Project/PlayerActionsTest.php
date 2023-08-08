<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class PlayerActionsTest extends TestCase
{
    /**
     * Test getLatestAction().
     */
    public function testGetLatestAction()
    {
        $playerActions = new PlayerActions();
        $playerActions->addToRoundActions("fold");
        $playerActions->addToRoundActions("call");
        $playerActions->addToRoundActions("raise");
        $this->assertEquals("raise", $playerActions->getLatestAction());
    }

    /**
     * Test clearRoundActions()
     */
    public function testClearRoundActions()
    {
        $playerActions = new PlayerActions();
        $playerActions->addToRoundActions("fold");
        $playerActions->addToRoundActions("call");
        $playerActions->addToRoundActions("raise");
        $playerActions->clearRoundActions();
        $this->assertEquals([], $playerActions->getRoundActions());
    }

    /**
     * Test setHasFolded()
     */
    public function testSetHasFolded()
    {
        $playerActions = new PlayerActions();
        $playerActions->setHasFolded();
        $this->assertEquals(true, $playerActions->hasFolded());

        $playerActions->setHasFolded();
        $this->assertEquals(false, $playerActions->hasFolded());

    }
}
