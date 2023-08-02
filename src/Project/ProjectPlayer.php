<?php

namespace App\Project;

use App\Cards\CardHand;

class ProjectPlayer implements PlayerInterface
{
    /**
     * @var string $name The name of the player.
     * @var string $role The role of the player.
     * @var int $chips The amount of chips the player has.
     * @var int $bets The amount of chips the player has bet.
     * @var int $totalBets The total amount of chips the player has bet this round.
     * @var CardHand $hand The hand of the player.
     * @var PlayerActions $playerActions The moves the player can make.
     */

    private string $name;
    private string $role = "";
    private int $chips;
    private int $bets = 0;
    private int $totalBets = 0;
    protected CardHand $hand;
    protected int $handValue = 0;
    protected PlayerActions $playerActions;

    /**
     * Player constructor.
     *
     * @param string $name The name of the player.
     *
     */
    public function __construct(string $name, int $initialChips)
    {
        $this->name = $name;
        $this->chips = $initialChips;
        $this->hand = new CardHand();
        $this->playerActions = new PlayerActions();
    }

    /**
     * Get the name of the player.
     *
     * @return string The name of the player.
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * Set the role of the player.
     *
     * @param string $role The role of the player.
     *
     * @return void
     */
    public function setRole(string $role): void
    {
        $this->role = $role;
    }

    /**
     * Get the players chips.
     * 
     * @return int The amount of chips the player has.
     */
    public function getChips(): int
    {
        return $this->chips;
    }

    /**
     * Increase the players chips.
     * 
     * @param int $money The amount of chips to increase with.
     * 
     * @return void
     */
    public function increaseChips(int $money): void
    {
        $this->chips += $money;
    }

    /**
     * Decrease the players chips.
     * 
     * @param int $money The amount of chips to decrease with.
     * 
     * @return void
     */
    public function decreaseChips(int $money): void
    {
        $this->chips -= $money;
    }

    /**
     * Get the players bets.
     * 
     * @return int The amount of chips the player has bet.
     */
    public function getBets(): int
    {
        return $this->bets;
    }

    /**
     * Add to the players bets.
     * 
     * @param int $betAmount The amount of chips to add to the players bets.
     * 
     * @return void
     */
    public function addToBets(int $betAmount): void
    {
        $this->bets += $betAmount;
    }

    /**
     * Clear the players bets.
     * 
     * @return void
     */
    public function clearPlayerBets(): void
    {
        $this->totalBets += $this->bets;
        $this->bets = 0;
    }

    /**
     * Get total bets.
     * 
     * @return int The total amount of chips the player has bet this round.
     */
    public function getTotalBets(): int
    {
        return $this->totalBets;
    }

    /**
     * Get the players hand.
     * 
     * @return CardHand The players hand.
     */
    public function getHand(): CardHand
    {
        return $this->hand;
    }

    /**
     * Set the players hand.
     * 
     * @param CardHand $hand The hand to set.
     * 
     * @return void
     */
    public function setHand(CardHand $hand): void
    {
        $this->hand = $hand;
    }

    /**
     * Get the players moves.
     * 
     * @return PlayerActions The players moves.
     */
    public function getPlayerActions(): PlayerActions
    {
        return $this->playerActions;
    }

    /**
     * Get the players hand value.
     * 
     * @return int The players hand value.
     */
    public function getHandValue(): int
    {
        return $this->handValue;
    }

    /**
     * Set the players hand value.
     * 
     * @param int $handValue The hand value to set.
     * 
     * @return void
     */
    public function setHandValue(int $handValue): void
    {
        $this->handValue = $handValue;
    }

    public function getRole(): string
    {
        return $this->role;
    }

    /**
     * Get the players data.
     * 
     * @return array<string, mixed> The players data.
     */
    public function getPlayerData(): array
    {
        return [
            "name" => $this->name,
            "role" => $this->getRole(),
            "chips" => $this->chips,
            "folded" => $this->playerActions->hasFolded(),
            "bets" => $this->bets,
            "totalBets" => $this->totalBets,
            "hand" => $this->hand->getHand(),
            "playerActions" => $this->playerActions->getPlayerActions(),
        ];
    }

}