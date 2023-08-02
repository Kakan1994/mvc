<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;

/**
 * Class Game represents a game of poker.
 */
class ProjectGame
{
    /**
     * @var ListOfPlayers $listOfPlayers   The list of players.
     */
    private $listOfPlayers;

    /**
     * @var DeckOfCards $deck   The deck.
     */
    private $deck;

    /**
     * @var CardHands $cardHands   The possible card hands.
     */
    private $cardHands;

    /**
     * @var int $totalPot   The total pot.
     */
    private $totalPot;

    /**
     * @var int $highestBet   The highest bet.
     */
    private $highestBet;

    /**
     * @var CardHand $openCards   The open cards.
     */
    private $openCards;

    /**
     * @var CardHand $discardedCards   The discarded cards.
     */ 
    private $discardedCards;

    /**
     * @var int $smallBlind   The small blind.
     */
    private $smallBlind;

    /**
     * @var int $bigBlind   The big blind.
     */
    private $bigBlind;

    /**
     * @var int $round   The round.
     */
    private $round;

    public function __construct()
    {
        $this->listOfPlayers = new ListOfPlayers();
        $this->deck = new DeckOfCards();
        $this->cardHands = new CardHands();
        $this->totalPot = 0;
        $this->highestBet = 0;
        $this->openCards = new CardHand();
        $this->discardedCards = new CardHand();
        $this->smallBlind = 5;
        $this->bigBlind = 10;
        $this->round = 0;
    }

    /**
     * Start the game.
     */
    public function initializeGame(int $numberOfPlayers): void
    {

    }


}
