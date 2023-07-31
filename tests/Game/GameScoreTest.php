<?php

namespace App\Game;

use PHPUnit\Framework\TestCase;

class GameScoreTest extends TestCase
{
    /**
     * Construct object.
     */
    public function testCreateObject(): void
    {
        $game = new GameScore();
        $this->assertInstanceOf("\App\Game\GameScore", $game);
    }
}