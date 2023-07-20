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
    protected $dealer;
    /**
     * @var DeckOfCards
     */
    private $deck;
    /**
     * @var int
     */
    private $playerScore ;
    /**
     * @var int
     */
    private $dealerScore;
    /**
     * @var int
     */
    private $lastPlayerScore;
    /**
     * @var int
     */
    private $lastDealerScore;
    /**
     * @var string|null
     */
    private $winner;
    /**
     * @var bool
     */
    private $gameOver;

    public function __construct()
    {
        $this->player = new Player('Player');
        $this->dealer = new Dealer();
        $this->deck = new DeckOfCards();
        $this->playerScore = 0;
        $this->dealerScore = 0;
        $this->lastPlayerScore = 0;
        $this->lastDealerScore = 0;
        $this->setWinner('First round');
        $this->gameOver = false;
    }

    public function startGame(): void
    {
        $this->deck->shuffle();
        $this->player->drawCard($this->deck);
        $this->dealer->drawHiddenCard($this->deck);
        $this->player->drawCard($this->deck);
        $this->dealer->drawCard($this->deck);
        $this->playerScore = $this->calculateScore($this->player->getHand());
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
        $this->gameOver = false;
    }

    public function calculateScore(CardHand $hand): int
    {
        $score = 0;
        $cards = $hand->getCards();
        foreach ($cards as $card) {
            $value = $card->getValue();
            if ($value === 'A') {
                $score += $score + 11 > 21 ? 1 : 11;
                continue;
            } elseif ($value === 'J' || $value === 'Q' || $value === 'K') {
                $score += 10;
                continue;
            }
            $score += intval($value);
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

    public function revealDealerCard(): void
    {
        if ($this->dealer->isHiddenCardRevealed() === false) {
            $this->dealer->revealHiddenCard();
        }
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
    }

    public function hit(): void
    {
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->playerScore  = $this->calculateScore($this->player->getHand());
        if ($this->playerScore  === 21) {
            $this->stand();
        }
        if ($this->playerScore  > 21) {
            $this->setWinner('Dealer');
            $this->gameOver();
        }
    }

    public function stand(): void
    {
        $this->dealer->revealHiddenCard();
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
        $this->playerScore  = $this->calculateScore($this->player->getHand());
        while ($this->dealerScore < 17) {
            $this->checkDeck();
            $this->dealer->drawCard($this->deck);
            $this->dealerScore = $this->calculateScore($this->dealer->getHand());
        }
        if ($this->dealerScore > 21) {
            $this->setWinner('Player');
            $this->gameOver();
        } elseif ($this->dealerScore < $this->playerScore) {
            $this->setWinner('Player');
            $this->gameOver();
        } elseif ($this->dealerScore > $this->playerScore || $this->dealerScore === $this->playerScore) {
            $this->setWinner('Dealer');
        }
        $this->gameOver();
    }

    public function getPlayerScore(): int
    {
        return $this->playerScore;
    }

    public function getLastPlayerScore(): int
    {
        return $this->lastPlayerScore;
    }

    public function getDealerScore(): int
    {
        return $this->dealerScore;
    }

    public function getLastDealerScore(): int
    {
        return $this->lastDealerScore;
    }

    public function getWinner(): string
    {
        if ($this->winner === null) {
            error_log('Attempted to get $winner when it is null');
            debug_print_backtrace();
            return 'Error';
        }
        return $this->winner;
    }

    public function setWinner(?string $winner): void
    {
        if ($winner === null) {
            error_log('Attempted to set $winner to null');
            debug_print_backtrace();
        }
        $this->winner = $winner;
    }

    public function gameOver(): void
    {
        $this->gameOver = true;
    }

    public function isGameOver(): bool
    {
        return $this->gameOver;
    }

    public function reset(): void
    {
        $this->player = new Player('Player');
        $this->dealer = new Dealer();
        $this->deck = new DeckOfCards();
        $this->playerScore = 0;
        $this->dealerScore = 0;
        $this->lastPlayerScore = 0;
        $this->lastDealerScore = 0;
        $this->startGame();
    }

    public function newRound(): void
    {
        $this->gameOver = false;
        $this->player->clearHand();
        $this->dealer->clearHand();
        $this->lastPlayerScore = $this->playerScore;
        $this->lastDealerScore = $this->dealerScore;
        $this->playerScore = 0;
        $this->dealerScore = 0;
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawHiddenCard($this->deck);
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawCard($this->deck);
        $this->playerScore = $this->calculateScore($this->player->getHand());
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
    }

    public function checkDeck(): void
    {
        $remainingCards = count($this->deck->getCards());
        if ($remainingCards < 1) {
            $this->deck = new DeckOfCards();
            $this->deck->shuffle();
            error_log('Deck shuffled');
        }
    }

    /**
     * @return array{
     *      playerCards: array<int, string>,
     *      dealerCards: array<int, string>,
     *      dealerHiddenCardRevealed: bool,
     *      playerScore: int,
     *      dealerScore: int,
     *      lastPlayerScore: int,
     *      lastDealerScore: int,
     *      lastWinner: string|null
     * }
     */
    public function jsonSerialize(): array
    {
        return [
            'playerCards' => $this->player->getHand()->getCardsAsArray(),
            'dealerCards' => $this->dealer->getHand()->getCardsAsArray(),
            'dealerHiddenCardRevealed' => $this->dealer->isHiddenCardRevealed(),
            'playerScore' => $this->playerScore,
            'dealerScore' => $this->dealerScore,
            'lastPlayerScore' => $this->lastPlayerScore,
            'lastDealerScore' => $this->lastDealerScore,
            'lastWinner' => $this->winner,
        ];
    }
}
