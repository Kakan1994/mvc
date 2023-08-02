<?php

namespace App\Project;

use Exception;

class GameQueue
{
    private array $players;

    private PlayerInterface $smallBlindPlayer;

    private PlayerInterface $bigBlindPlayer;

    private PlayerInterface $dealerPlayer;

    public function __construct(array $players)
    {
        $this->players = $players;
    }

    public function setRolesBeforeStart(): array
    {
        $this->dealerPlayer = $this->dequePlayer();
        $this->smallBlindPlayer = $this->dequePlayer();
        $this->bigBlindPlayer = $this->dequePlayer();

        $this->EnquePlayer($this->dealerPlayer);
        $this->EnquePlayer($this->smallBlindPlayer);
        $this->EnquePlayer($this->bigBlindPlayer);

        $this->dealerPlayer->setRole("Dealer");
        $this->smallBlindPlayer->setRole("Small Blind");
        $this->bigBlindPlayer->setRole("Big Blind");

        return $this->players;
    }

    public function dequePlayer(): PlayerInterface
    {
        if (empty($this->players)) {
            throw new Exception("No players in queue");
        }
        return array_shift($this->players);
    }

    public function enquePlayer(PlayerInterface $player): void
    {
        array_push($this->players, $player);
    }

    public function peek(): PlayerInterface
    {
        if (empty($this->players)) {
            throw new Exception("No players in queue");
        }
        return $this->players[0];
    }

    public function getQue(): array
    {
        return $this->players;
    }

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

        $this->dealerPlayer->setRole("Dealer");
        $this->smallBlindPlayer->setRole("Small Blind");
        $this->bigBlindPlayer->setRole("Big Blind");

        return $this->players;
    }

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
    }

    public function getSmallBlindPlayer(): PlayerInterface
    {
        return $this->smallBlindPlayer;
    }

    public function getBigBlindPlayer(): PlayerInterface
    {
        return $this->bigBlindPlayer;
    }
}