<?php

namespace App\Project;

use App\Cards\CardHand;

/**
 * Interface PlayerInterface
 *
 * This interface is used to represent a player in the game.
 */
interface PlayerInterface
{
    public function getName(): string;

    public function setRole(string $role): void;

    public function getRole(): string;

    public function getChips(): int;

    public function increaseChips(int $money): void;

    public function decreaseChips(int $money): void;

    public function getBets(): int;

    public function addToBets(int $betAmount): void;

    public function clearPlayerBets(): void;

    public function getHand(): CardHand;

    public function setHand(CardHand $hand): void;

    public function getPlayerActions(): PlayerActions;

    public function isHuman(): bool;

    public function resetBest5CardHand(): void;

    public function setBest5CardHand(CardHand $hand): void;

    public function getBest5CardHandArray(): array;

    /**
     * @return array<string, mixed>
     */
    public function getPlayerData(): array;
}
