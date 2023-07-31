<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

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
     * @var GameScore $gameScore   The score of the game.
     */
    private $gameScore;

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
        $this->gameScore = new GameScore();
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
        $this->gameScore->setPlayerScore($this->gameScore->calculateScore($this->player->getHand()));
        $this->gameScore->setDealerScore($this->gameScore->calculateScore($this->dealer->getHand()));
        $this->gameOver = false;
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
     * Get the score of the game.
     * @return GameScore   The score of the game.
     */
    public function getGameScore(): GameScore
    {
        return $this->gameScore;
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
        $this->gameScore->setDealerScore($this->gameScore->calculateScore($this->dealer->getHand()));
    }

    /**
     * Hit for the player.
     * @return void
     */
    public function hit(): void
    {
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->gameScore->setPlayerScore($this->gameScore->calculateScore($this->player->getHand()));
        if ($this->gameScore->getPlayerScore()  === 21) {
            $this->stand();
        }
        if ($this->gameScore->getPlayerScore()  > 21) {
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
        $this->gameScore->setDealerScore($this->gameScore->calculateScore($this->dealer->getHand()));
        $this->gameScore->setPlayerScore($this->gameScore->calculateScore($this->player->getHand()));

        $this->dealerPlay();

        if ($this->gameScore->getDealerScore() > 21 || $this->gameScore->getDealerScore() < $this->gameScore->getPlayerScore()) {
            $this->setWinner('Player');
            $this->gameOver();
            return;
        }

        $this->setWinner('Dealer');
        $this->gameOver();
    }

    public function dealerPlay(): void
    {
        while ($this->gameScore->getDealerScore() < 17) {
            $this->checkDeck();
            $this->dealer->drawCard($this->deck);
            $this->gameScore->setDealerScore($this->gameScore->calculateScore($this->dealer->getHand()));
        }
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
        $this->gameScore->setPlayerScore(0);
        $this->gameScore->setDealerScore(0);
        $this->gameScore->setLastPlayerScore(0);
        $this->gameScore->setLastDealerScore(0);
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
        $this->gameScore->setLastPlayerScore($this->gameScore->getPlayerScore());
        $this->gameScore->setLastDealerScore($this->gameScore->getDealerScore());
        $this->gameScore->setPlayerScore(0);
        $this->gameScore->setDealerScore(0);
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawHiddenCard($this->deck);
        $this->checkDeck();
        $this->player->drawCard($this->deck);
        $this->checkDeck();
        $this->dealer->drawCard($this->deck);
        $this->gameScore->setPlayerScore($this->gameScore->calculateScore($this->player->getHand()));
        $this->gameScore->setDealerScore($this->gameScore->calculateScore($this->dealer->getHand()));
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
     * @return array<string, array<int, string>|bool|int|string|null> Array with keys:
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
            'playerScore' => $this->gameScore->getPlayerScore(),
            'dealerScore' => $this->gameScore->getDealerScore(),
            'lastPlayerScore' => $this->gameScore->getLastPlayerScore(),
            'lastDealerScore' => $this->gameScore->getLastDealerScore(),
            'lastWinner' => $this->winner,
        ];
    }
}
