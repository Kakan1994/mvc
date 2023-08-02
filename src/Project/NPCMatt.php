<?php

namespace App\Project;

use App\Cards\CardHand;

class NPCMatt extends NPCLogic implements PlayerInterface
{
    protected string $name;
    protected string $role = "";
    protected int $chips;
    protected int $bets = 0;
    protected CardHand $hand;
    protected PlayerActions $playerActions;

    /**
     * NPC constructor.
     *
     * @param string $name The name of the NPC.
     * @param int $initialChips The amount of chips the NPC starts with.
     */
    public function __construct(string $name, int $initialChips)
    {
        $this->name = $name;
        $this->chips = $initialChips;
        $this->hand = new CardHand();
        $this->playerActions = new PlayerActions();
    }

    /**
     * Get the name of the NPC.
     *
     * @return string The name of the NPC.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the role of the NPC.
     *
     * @param string $role The role of the NPC.
     *
     * @return void
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Get the role of the NPC.
     *
     * @return string The role of the NPC.
     */
    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Get the amount of chips the NPC has.
     *
     * @return int The amount of chips the NPC has.
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * Increase the amount of chips the NPC has.
     *
     * @param int $money The amount of chips to increase the NPC's chips with.
     *
     * @return void
     */
    public function increaseChips(int $money): void
    {
        $this->chips += $money;
    }

    /**
     * Decrease the amount of chips the NPC has.
     *
     * @param int $money The amount of chips to decrease the NPC's chips with.
     *
     * @return void
     */
    public function decreaseChips(int $money): void
    {
        $this->chips -= $money;
    }

    /**
     * Get the amount of chips the NPC has bet.
     *
     * @return int The amount of chips the NPC has bet.
     */
    public function getBets(): int
    {
        return $this->bets;
    }

    /**
     * Add to the amount of chips the NPC has bet.
     *
     * @param int $betAmount The amount of chips to add to the NPC's bets.
     *
     * @return void
     */
    public function addToBets(int $betAmount): void
    {
        $this->bets += $betAmount;
    }

    /**
     * Clear the amount of chips the NPC has bet.
     *
     * @return void
     */
    public function clearPlayerBets(): void
    {
        $this->bets = 0;
    }

    /**
     * Get the NPC's hand.
     *
     * @return CardHand The NPC's hand.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Set the NPC's hand.
     *
     * @param CardHand $hand The NPC's hand.
     *
     * @return void
     */
    public function setHand(CardHand $hand): void
    {
        $this->hand = $hand;
    }

    /**
     * Get the NPC's player actions.
     *
     * @return PlayerActions The NPC's player actions.
     */
    public function getPlayerActions(): PlayerActions
    {
        return $this->playerActions;
    }

    /**
     * Get the NPC's data.
     *
     * @return array<string, mixed> The NPC's data.
     */
    public function getPlayerData(): array
    {
        return [
            "name" => $this->name,
            "role" => $this->role,
            "chips" => $this->chips,
            "bets" => $this->bets,
            "hand" => $this->hand->getCards(),
            "playerActions" => $this->playerActions->getPlayerActions(),
        ];
    }

}