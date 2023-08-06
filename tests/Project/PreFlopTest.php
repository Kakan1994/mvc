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
}
