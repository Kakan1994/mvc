<?php

namespace App\Project;

use Exception;

/**
 * Class GameQueue
 * 
 * This class is used to store the game queue.
 */
class GameQueue
{
    /**
     * @var array $players The players in the game.
     */
    private array $players;
    
    /**
     * @var PlayerInterface $smallBlindPlayer The small blind player.
     */
    private PlayerInterface $smallBlindPlayer;

    /**
     * @var PlayerInterface $bigBlindPlayer The big blind player.
     */
    private PlayerInterface $bigBlindPlayer;

    /**
     * @var PlayerInterface $dealerPlayer The dealer player.
     */
    private PlayerInterface $dealerPlayer;

    /**
     * Constructor.
     * 
     * @param array $players The players.
     */
    public function __construct(array $players)
    {
        $this->players = $players;
    }

    /**
     * Set the roles before the start of the game.
     * 
     * @return array The players.
     */
    public function setRolesBeforeStart(): array
    {
        $this->dealerPlayer = $this->dequePlayer();
        $this->smallBlindPlayer = $this->dequePlayer();
        $this->bigBlindPlayer = $this->dequePlayer();

        $this->EnquePlayer($this->dealerPlayer);
        $this->EnquePlayer($this->smallBlindPlayer);
        $this->EnquePlayer($this->bigBlindPlayer);

        $this->dealerPlayer->setRole("dealer");
        $this->smallBlindPlayer->setRole("small blind");
        $this->bigBlindPlayer->setRole("big blind");

        return $this->players;
    }

    /**
     * Remove the first player from the queue.
     * 
     * @return PlayerInterface The player.
     */
    public function dequePlayer(): PlayerInterface
    {
        if (empty($this->players)) {
            throw new Exception("No players in queue");
        }
        return array_shift($this->players);
    }

    /**
     * Add a player to the queue.
     * 
     * @param PlayerInterface $player The player.
     * 
     * @return void
     */
    public function enquePlayer(PlayerInterface $player): void
    {
        array_push($this->players, $player);
    }

    /**
     * Get the first player in the queue.
     * 
     * @return PlayerInterface The player.
     */
    public function peek(): PlayerInterface
    {
        if (empty($this->players)) {
            throw new Exception("No players in queue");
        }
        return $this->players[0];
    }

    /**
     * Get the players in the queue.
     * 
     * @return array The players.
     */
    public function getQue(): array
    {
        return $this->players;
    }

    /**
     * Set the queue before the start of the game.
     * 
     * @return array The players.
     */
    public function setQueBeforeStart(): array
    {
        $players = $this->getQue();
        $numOfPlayers = count($players);

        for ($i = 0; $i < $numOfPlayers; $i++) {
            $this->dequePlayer();
        }

        $theDealer = $this->dealerPlayer;

        $this->dealerPlayer = $this->smallBlindPlayer;
        $this->smallBlindPlayer = $this->bigBlindPlayer;
        $this->bigBlindPlayer = $theDealer;

        $this->enquePlayer($this->dealerPlayer);
        $this->enquePlayer($this->smallBlindPlayer);
        $this->enquePlayer($this->bigBlindPlayer);

        $this->dealerPlayer->setRole("dealer");
        $this->smallBlindPlayer->setRole("small blind");
        $this->bigBlindPlayer->setRole("big blind");

        return $this->players;
    }

    /**
     * Shift the players in the queue.
     * 
     * @return array The players.
     */
    public function shiftPlayers(): array
    {
        $players = $this->getQue();
        $numOfPlayers = count($players);

        for ($i = 0; $i < $numOfPlayers; $i++) {
            $this->dequePlayer();
        }

        $this->enquePlayer($this->smallBlindPlayer);
        $this->enquePlayer($this->bigBlindPlayer);
        $this->enquePlayer($this->dealerPlayer);

        return $this->players;
    }

    /**
     * Get the player who is the small blind.
     * 
     * @return PlayerInterface The player.
     */
    public function getSmallBlindPlayer(): PlayerInterface
    {
        return $this->smallBlindPlayer;
    }

    /**
     * Get the player who is the big blind.
     * 
     * @return PlayerInterface The player.
     */
    public function getBigBlindPlayer(): PlayerInterface
    {
        return $this->bigBlindPlayer;
    }
}