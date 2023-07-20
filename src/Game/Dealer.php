<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;

class Dealer extends Player
{
    /**
     * @var Card[]
     */
    private $hiddenCard;

    public function __construct()
    {
        parent::__construct('Dealer');
        $this->hiddenCard = [];
    }

    public function drawCard(DeckOfCards $deck): void
    {
        $this->hand->addCard($deck->draw()[0]);
    }

    public function drawHiddenCard(DeckOfCards $deck): void
    {
        $this->hiddenCard = $deck->draw()[0];
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

    public function revealHiddenCard(): void
    {
        $this->hand->addCard($this->hiddenCard);
        $this->hiddenCard = [];
    }
}