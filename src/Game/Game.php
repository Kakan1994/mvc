<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;
use App\Game\Dealer;

/**
 * Class Game
 *
 * Represents a game of blackjack.
 */
class Game
{
    /**
     * @var Player $player   The player.
     */
    private $player;

    /**
     * @var Dealer $dealer   The dealer.
     */
    protected $dealer;

    /**
     * @var DeckOfCards $deck   The deck.
     */
    private $deck;

    /**
     * @var int $playerScore   The score of the player.
     */
    private $playerScore;

    /**
     * @var int $dealerScore   The score of the dealer.
     */
    private $dealerScore;

    /**
     * @var int $lastPlayerScore   The score of the player in the last round.
     */
    private $lastPlayerScore;

    /**
     * @var int $lastDealerScore   The score of the dealer in the last round.
     */
    private $lastDealerScore;

    /**
     * @var string|null $winner   The winner of the last round.
     */
    private $winner;

    /**
     * @var bool $gameOver   Whether the game is over or not.
     */
    private $gameOver;

    /**
     * Game constructor.
     */
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

    /**
     * Start the game.
     * @param bool $shuffle   Whether to shuffle the deck or not.
     * @return void
     */
    public function startGame(bool $shuffle = true): void
    {
        if ($shuffle === true) {
            $this->deck->shuffle();
        }
        $this->player->drawCard($this->deck);
        $this->dealer->drawHiddenCard($this->deck);
        $this->player->drawCard($this->deck);
        $this->dealer->drawCard($this->deck);
        $this->playerScore = $this->calculateScore($this->player->getHand());
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
        $this->gameOver = false;
    }

    /**
     * Calculate the score of a hand.
     * @param CardHand $hand   The hand to calculate the score of.
     * @return int   The score of the hand.
     */
    public function calculateScore(CardHand $hand): int
    {
        $scoreValues = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            'J' => '10',
            'Q' => '10',
            'K' => '10',
            'A' => '11',
        ];
        $score = 0;
        $aces = 0;
        $cards = $hand->getCards();
        foreach ($cards as $card) {
            if ($card->getValue() === 'A') {
                $aces += 1;
            }
            $value = $card->getValue();
            $score += intval($scoreValues[$value]);
        }
        if ($score > 21 && $aces > 0) {
            while ($aces > 0 && $score > 21) {
                $score -= 10;
                $aces -= 1;
            }
        }
        return $score;
    }

    /**
     * Get the player.
     * @return Player   The player.
     */
    public function getPlayer(): Player
    {
        return $this->player;
    }

    /**
     * Get the dealer.
     * @return Dealer   The dealer.
     */
    public function getDealer(): Dealer
    {
        return $this->dealer;
    }

    /**
     * Get the deck.
     * @return DeckOfCards   The deck.
     */
    public function getDeck(): DeckOfCards
    {
        return $this->deck;
    }

    /**
     * Reveal the dealers hidden card.
     * @return void
     */
    public function revealDealerCard(): void
    {
        if ($this->dealer->isHiddenCardRevealed() === false) {
            $this->dealer->revealHiddenCard();
        }
        $this->dealerScore = $this->calculateScore($this->dealer->getHand());
    }

    /**
     * Hit for the player.
     * @return void
     */
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

    /**
     * Stand for the player. The dealer will draw cards until it has a score of 17 or higher.
     * @return void
     */
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

    /**
     * Get the score of the player.
     * @return int   The score of the player.
     */
    public function getPlayerScore(): int
    {
        return $this->playerScore;
    }

    /**
     * Get the score of the player in the last round.
     * @return int   The score of the player in the last round.
     */
    public function getLastPlayerScore(): int
    {
        return $this->lastPlayerScore;
    }

    /**
     * Get the score of the dealer.
     * @return int   The score of the dealer.
     */
    public function getDealerScore(): int
    {
        return $this->dealerScore;
    }

    /**
     * Get the score of the dealer in the last round.
     * @return int   The score of the dealer in the last round.
     */
    public function getLastDealerScore(): int
    {
        return $this->lastDealerScore;
    }

    /**
     * Get the winner of the last round.
     * @return string   The winner of the last round.
     */
    public function getWinner(): ?string
    {
        return $this->winner;
    }

    /**
     * Set the winner of the last round.
     * @param string|null $winner   The winner of the last round.
     * @return void
     */
    public function setWinner(?string $winner): void
    {
        if ($winner === null) {
            throw new GameException('Error');
        }
        $this->winner = $winner;
    }

    /**
     * End the game.
     * @return void
     */
    public function gameOver(): void
    {
        $this->gameOver = true;
    }

    /**
     * Check if the game is over.
     * @return bool   Whether the game is over or not.
     */
    public function isGameOver(): bool
    {
        if ($this->gameOver === true) {
            return true;
        }
        return false;
    }

    /**
     * Reset the game.
     * @return void
     */
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

    /**
     * Start a new round.
     * @return void
     */
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

    /**
     * Check if the deck is empty and if so, create a new deck and shuffle it.
     * @return void
     */
    public function checkDeck(): void
    {
        $remainingCards = count($this->deck->getCards());
        if ($remainingCards < 1) {
            $this->deck = new DeckOfCards();
            $this->deck->shuffle();
        }
    }

    /**
     * Set the deck.
     * @param DeckOfCards $deck   The deck.
     * @return void
     */
    public function setDeck(DeckOfCards $deck): void
    {
        $this->deck = $deck;
    }

    /**
    * Serialize the game to JSON.
    *
    * @return array Array with keys:
    *      'playerCards' (array<int, string>),
    *      'dealerCards' (array<int, string>),
    *      'dealerHiddenCardRevealed' (bool),
    *      'playerScore' (int),
    *      'dealerScore' (int),
    *      'lastPlayerScore' (int),
    *      'lastDealerScore' (int),
    *      'lastWinner' (string|null)
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
