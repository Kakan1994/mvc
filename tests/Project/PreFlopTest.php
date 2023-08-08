<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class PreFlopTest extends TestCase{

    public function testPreFlop(): void
    {
        $preFlop = new PreFlop();

        $this->assertInstanceOf(
            PreFlop::class,
            $preFlop
        );
    }

    /**
     * Test getRankingsArray() method.
     */
    public function testGetRankingsArray(): void
    {
        $preFlop = new PreFlop();

        $this->assertIsArray(
            $preFlop->getRankingsArray()
        );
    }

    /**
     * Test getHandByCardsAndType() method.
     */
    public function testGetHandByCardsAndType(): void
    {
        $preFlop = new PreFlop();

        $res= $preFlop->getHandByCardsAndType(
            "AK",
            "s"
        );
        $exp = 4;
        $this->assertEquals(
            $exp,
            $res
        );
        
    }
}
