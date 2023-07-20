<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;
use App\Game\Dealer;

class Game
{
    /**
     * @var Player
     */
    private $player;
    /**
     * @var Dealer
     */
    private $dealer;
    /**
     * @var DeckOfCards
     */
    private $deck;
    /**
     * @var int
     */
    private $playerScore;
    /**
     * @var int
     */
    private $dealerScore;

    public function __construct()
    {
        $this->player = new Player('Player');
        $this->dealer = new Dealer();
        $this->deck = new DeckOfCards();
        $this->playerScore = 0;
        $this->dealerScore = 0;
    }

    public function start(): void
    {
        $this->deck->shuffle();
        $this->player->drawCard($this->deck);
        $this->dealer->drawHiddenCard($this->deck);
        $this->player->drawCard($this->deck);
        $this->dealer->drawCard($this->deck);
    }

    public function calculateScore(CardHand $hand): int
    {
        $score = 0;
        $cards = $hand->getCards();
        foreach ($cards as $card) {
            $value = $card->getValue();
            if ($value === 'A') {
                if ($score + 11 > 21) {
                    $score += 1;
                } else {
                    $score += 11;
                }
            } elseif ($value === 'J' || $value === 'Q' || $value === 'K') {
                $score += 10;
            } else {
                $score += intval($value);
            }
        }
        return $score;
    }

    public function getPlayer(): Player
    {
        return $this->player;
    }

    public function getDealer(): Dealer
    {
        return $this->dealer;
    }

    public function getDeck(): DeckOfCards
    {
        return $this->deck;
    }

    public function hit(): void
    {
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $playerScore = $this->calculateScore($this->player->getHand());
        if ($playerScore > 21) {
            $this->dealer->addScore(1);
        }
    }

    public function stand(): void
    {
        $this->dealer->revealHiddenCard();
        $dealerScore = $this->calculateScore($this->dealer->getHand());
        $playerScore = $this->calculateScore($this->player->getHand());
        while ($dealerScore < 17) {
            $this->checkDeck();
            $this->dealer->drawCard($this->deck);
            $dealerScore = $this->calculateScore($this->dealer->getHand());
        }
        if ($dealerScore > 21) {
            $this->player->addScore(1);
        } elseif ($dealerScore > $playerScore) {
            $this->dealer->addScore(1);
        } elseif ($dealerScore < $playerScore) {
            $this->player->addScore(1);
        }
    }

    public function getPlayerScore(): int
    {
        return $this->playerScore;
    }

    public function getDealerScore(): int
    {
        return $this->dealerScore;
    }

    public function reset(): void
    {
        $this->player = new Player('Player');
        $this->dealer = new Dealer();
        $this->deck = new DeckOfCards();
        $this->playerScore = 0;
        $this->dealerScore = 0;
    }

    public function newRound(): void
    {
        $this->player->getHand()->clear();
        $this->dealer->getHand()->clear();
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawHiddenCard($this->deck);
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawCard($this->deck);
    }

    public function checkDeck(): void
    {
        $remainingCards = count($this->deck->getCards());
        if ($remainingCards < 1) {
            $this->deck->shuffle();
        }
    }
}