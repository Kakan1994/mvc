<?php

namespace App\Project;

/**
 * Class PlayerActions
 *
 * Represents the actions a player can perform.
 */
class PlayerActions
{
    /**
     * @var array<string> $roundActions  The actions that can be performed in a round.
     */
    private array $roundActions = [];

    /**
     * @var bool $hasFolded Whether the player has folded or not.
     */
    private bool $hasFolded = false;

    /**
     * Add an action to the round actions.
     *
     * @param string $action The action to add.
     *
     * @return void
     */
    public function addToRoundActions(string $action): void
    {
        array_push($this->roundActions, $action);
    }

    /**
     * Get the round actions.
     *
     * @return array<string> The round actions.
     */
    public function getRoundActions(): array
    {
        return $this->roundActions;
    }

    /**
     * Returns player's latest round action.
     *
     * @return string The player's latest round action.
     */
    public function getLatestAction(): string
    {
        if (!empty($this->roundActions)) {
            $actions = $this->getRoundActions();
            return $actions[array_key_last($actions)];
        }
        return "";
    }

    /**
     * Clear the round actions.
     *
     * @return void
     */
    public function clearRoundActions(): void
    {
        $this->roundActions = [];
    }

    /**
     * Sets property hasFolded to true if false, and vice versa.
     *
     * @return void
     */
    public function setHasFolded(): void
    {
        $this->hasFolded = ($this->hasFolded)
            ? false
            : true;
    }

    /**
     * Returns whether the player has folded or not.
     *
     * @return bool Whether the player has folded or not.
     */
    public function hasFolded(): bool
    {
        if ($this->hasFolded) {
            return true;
        }
        return false;
    }

    /**
     * Returns the number of actions the player has taken.
     *
     * @return int The number of actions the player has taken.
     */
    public function getNumberOfActions(): int
    {
        return count($this->roundActions);
    }
}
