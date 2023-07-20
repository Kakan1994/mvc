<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

class Player
{
    /**
     * @var string
     */
    protected $name;
    /**
     * @var CardHand
     */
    protected $hand;
    /**
     * @var int
     */
    protected $score;

    public function __construct(string $name)
    {
        $this->name = $name;
        $this->hand = new CardHand();
        $this->score = 0;
    }

    public function drawCard(DeckOfCards $deck): void
    {
        $this->hand->addCard($deck->draw()[0]);
    }

    public function getHand(): CardHand
    {
        return $this->hand;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function getScore(): int
    {
        return $this->score;
    }

    public function addScore(int $score): void
    {
        $this->score += $score;
    }

    public function clearHand(): void
    {
        $this->hand = new CardHand();
    }
}
