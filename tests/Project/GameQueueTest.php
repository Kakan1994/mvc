<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use PHPUnit\Framework\TestCase;

class GameQueueTest extends TestCase
{
    /**
     * Test that the GameQueue class can be created.
     */
    public function testGameQueue(): void
    {
        $gameQueue = new GameQueue(["player1", "player2"]);

        $this->assertInstanceOf(
            GameQueue::class,
            $gameQueue
        );
    }

    /**
     * Test setRolesBeforeStart
     */
    public function testSetRolesBeforeStart(): void
    {
        $player1 = new ProjectPlayer("player1", 100);
        $player2 = new ProjectPlayer("player2", 100);
        $player3 = new ProjectPlayer("player3", 100);
        $gameQueue = new GameQueue([$player1, $player2, $player3]);

        $this->assertIsArray(
            $gameQueue->setRolesBeforeStart()
        );

        $this->assertEquals(
            [$player1, $player2, $player3],
            $gameQueue->setRolesBeforeStart()
        );

        $res = $gameQueue->getSmallBlindPlayer()->getName();
        $exp = "player2";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->getBigBlindPlayer()->getName();
        $exp = "player3";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->peek()->getName();
        $exp = "player1";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->getQue();
        $exp = [$player1, $player2, $player3];
        $this->assertEquals($exp, $res);
    }

    /**
     * Test dequePlayer with empty queue
     */
    public function testDequePlayerWithEmptyQueue(): void
    {
        $gameQueue = new GameQueue([]);

        $this->expectException(\Exception::class);

        $gameQueue->dequePlayer();
    }

    /**
     * Test peek with empty queue
     */
    public function testPeekWithEmptyQueue(): void
    {
        $gameQueue = new GameQueue([]);

        $this->expectException(\Exception::class);

        $gameQueue->peek();
    }

    /**
     * Test setQueBeforeStart
     */
    public function testSetQueBeforeStart(): void
    {
        $player1 = new ProjectPlayer("player1", 100);
        $player2 = new ProjectPlayer("player2", 100);
        $player3 = new ProjectPlayer("player3", 100);
        $gameQueue = new GameQueue([$player1, $player2, $player3]);

        $gameQueue->setRolesBeforeStart();

        $this->assertIsArray(
            $gameQueue->setQueBeforeStart()
        );

        $queue = $gameQueue->setQueBeforeStart();
        $queueNames = [];
        foreach ($queue as $player) {
            $queueNames[] = $player->getName();
        }

        $this->assertEquals(
            ["player3", "player1", "player2"],
            $queueNames
        );


        $res = $gameQueue->getSmallBlindPlayer()->getName();
        $exp = "player1";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->getBigBlindPlayer()->getName();
        $exp = "player2";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->peek()->getName();
        $exp = "player3";
        $this->assertEquals($exp, $res);

        $res = $gameQueue->getQue();
        $exp = [$player3, $player1, $player2];
        $this->assertEquals($exp, $res);

        $res = $gameQueue->shiftPlayers();
        $exp = [$player1, $player2, $player3];
        $this->assertEquals($exp, $res);
    }
}