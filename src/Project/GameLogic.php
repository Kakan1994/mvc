<?php

namespace App\Project;
/**
 * Class GameLogic
 * 
 * This class is used to help with the game logic.
 */
class GameLogic
{
    /**
     * Check if the round is over.
     * 
     * @param array $players The players.
     * 
     * @return bool If the round is over.
     */
    public function isRoundOver(array $players): bool
    {
        $folded = 0;

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                $folded++;
            }
        }
        if ($folded >= count($players) - 1) {
            return true;
        }

        return false;
    }

    /**
     * Gets the highest bet.
     * 
     * @param array $players The players.
     * 
     * @return int The highest bet.
     */
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

    /**
     * Check if the player is ready.
     * 
     * @param PlayerInterface $player The player.
     * @param array $players The players.
     * 
     * @return bool If the player is ready.
     */
    public function isPlayerReady(PlayerInterface $player, array $players): bool
    {
        $highBet = $this->getHighestBet($players);

        if ($player->getBets() === $highBet && $player->getPlayerActions()->getNumberOfActions() > 0) {
            return true;
        }

        return false;
    }

    /**
     * Gets the number of folded players.
     * 
     * @param array $players The players.
     * 
     * @return int The number of folded players.
     */
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

    /**
     * Check if the next stage is ready.
     * 
     * @param array $players The players.
     * 
     * @return bool If the next stage is ready.
     */
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

    /**
     * Get the winner.
     * 
     * @param array $players The players.
     * 
     * @return PlayerInterface The winner.
     */
    public function getWinner(array $players): PlayerInterface
    {
        if ($this->isWinnerByFold($players)) {
            return $this->getWinnerByFold($players);
        }

        return $this->getWinnerByHand($players);
    }

    /**
     * Check if the winner is by fold.
     * 
     * @param array $players The players.
     * 
     * @return bool If the winner is by fold.
     */
    public function isWinnerByFold(array $players): bool
    {
        if ($this->getNumberOfFoldedPlayers($players) >= count($players) - 1) {
            return true;
        }

        return false;
    }

    /**
     * Get the winner by fold.
     * 
     * @param array $players The players.
     * 
     * @return PlayerInterface The winner.
     */
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

    /**
     * Get the winner by hand.
     * 
     * @param array $players The players.
     * 
     * @return PlayerInterface The winner.
     */
    public function getWinnerByHand(array $players): PlayerInterface
    {
        $count = count($players);

        $winner = $players[0];


        for ($i = 1; $i < $count; $i++) {
            if ($players[$i]->getPlayerActions()->hasFolded()) {
                continue;
            }
            if ($players[$i]->getHandValue() > $winner->getHandValue()) {
                $winner = $players[$i];
            }
        }

        return $winner;
    }

    /**
     * Check if the game is tied.
     * 
     * @param array $players The players.
     * 
     * @return bool If the game is tied.
     */
    public function isTied(array $players): bool
    {
        $handValues = [];

        foreach ($players as $player) {
            if ($player->getPlayerActions()->hasFolded()) {
                continue;
            }

            array_push($handValues, $player->getHandValue());
        }

        $uniqueHandValues = array_unique($handValues);

        if (count($uniqueHandValues) !== 1) {

            return false;
        }

        return true;
    }

    /**
     * Get the tied winners.
     * 
     * @param array $players The players.
     * 
     * @return array The tied winners.
     */
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