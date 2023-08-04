<?php

namespace App\Project;

class GameLogic
{
    public function isRoundOver(array $players): bool
    {
        $folded = 0;

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                $folded++;
            }
        }

        if ($folded === count($players) - 1) {
            return true;
        }

        return false;
    }

    public function getHighestBet(array $players): int
    {
        $highestBet = 0;

        foreach ($players as $player) {
            if ($player->getBets() > $highestBet) {
                $highestBet = $player->getBets();
            }
        }

        return $highestBet;
    }

    public function isPlayerReady(PlayerInterface $player, array $players): bool
    {
        $highBet = $this->getHighestBet($players);

        if ($player->getBets() === $highBet && $player->getPlayerActions()->getNumberOfActions() > 0) {
            return true;
        }

        return false;
    }

    public function getNumberOfFoldedPlayers(array $players): int
    {
        $folded = 0;

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                $folded++;
            }
        }

        return $folded;
    }

    public function checkNextStage(array $players): bool
    {
        $countRdy = 0;
        $nrOfPlayers = count($players);

        $folded = $this->getNumberOfFoldedPlayers($players);

        $playersLeft = $nrOfPlayers - $folded;

        foreach ($players as $player) {
            if ($this->isPlayerReady($player, $players)) {
                $countRdy++;
            }
        }

        if ($countRdy === $playersLeft) {
            return true;
        }

        return false;
    }

    public function getWinner(array $players): PlayerInterface
    {
        if ($this->isWinnerByFold($players)) {
            return $this->getWinnerByFold($players);
        }

        return $this->getWinnerByHand($players);
    }

    public function isWinnerByFold(array $players): bool
    {
        if ($this->getNumberOfFoldedPlayers($players) >= count($players) - 1) {
            return true;
        }

        return false;
    }

    public function getWinnerByFold(array $players): PlayerInterface
    {
        $winner = null;

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                continue;
            }

            $winner = $player;
        }

        return $winner;
    }

    public function getWinnerByHand(array $players): PlayerInterface
    {
        $count = count($players);

        $winner = $players[0];

        for ($i = 1; $i < $count; $i++) {
            if ($players[$i]->getHandValue() > $winner->getHandValue()) {
                $winner = $players[$i];
            }
        }

        return $winner;
    }

    public function isTied(array $players): bool
    {
        $handValues = [];

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                continue;
            }

            array_push($handValues, $player->getHand()->getHandValue());
        }

        $uniqueHandValues = array_unique($handValues);

        if (count($uniqueHandValues) === 1) {
            return true;
        }

        return false;
    }

    public function getTiedWinners(array $players): array
    {
        $winners = [];

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                continue;
            }

            array_push($winners, $player);
        }

        return $winners;
    }

}