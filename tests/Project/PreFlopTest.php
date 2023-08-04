<?php

namespace App\Project;

use PHPUnit\Framework\TestCase;

class PreFlopTest extends TestCase{
    public function testGetRankingsArray(): void
    {
        $preFlop = new PreFlop();
        $preFlopRanks = $preFlop->getRankingsArray();
        $testType = "s";
        $testValue = "92";

        foreach ($preFlopRanks as $rank) {
            if ($rank->type == $testType && $rank->cards == $testValue) {
                print_r($rank->ranks);
            }
        }

        print_r("\n");
        print_r($preFlop->getHandByCardsAndType("92", "o"));
    }
}
