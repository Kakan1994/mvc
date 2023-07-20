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
    /**
     * @var bool
     */
    protected $hiddenCardRevealed;

    public function __construct()
    {
        parent::__construct('Dealer');
        $this->hiddenCard = [];
    }

    public function drawHiddenCard(DeckOfCards $deck): void
    {
        $this->hiddenCard = $deck->draw();
        $this->hiddenCardRevealed = false;
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
        error_log(print_r($this->hiddenCard, true));
        $this->hand->addCard($this->hiddenCard[0]);
        $this->hiddenCardRevealed = true;
        $this->hiddenCard = [];
    }

    public function isHiddenCardRevealed(): bool
    {
        return $this->hiddenCardRevealed;
    }
}
