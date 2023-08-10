<?php

namespace App\Project;

use App\Cards\CardHand;

/**
 * Class NPCSteve
 *
 * Represents a NPC player.
 */
class NPCSteve extends NPCMatt implements PlayerInterface
{
    /**
     * @var int $riskLevel The risk level of the NPC.
     */
    private int $riskLevel = 0;

    /**
     * NPC constructor.
     *
     * @param string $name The name of the NPC.
     * @param int $initialChips The amount of chips the NPC starts with.
     */
    public function __construct(string $name, int $initialChips)
    {
        parent::__construct($name, $initialChips);
    }

    /**
     * Returns the risk level of the NPC.
     *
     * @return int The risk level of the NPC.
     */
    public function getRiskLevel(): int
    {
        return $this->riskLevel;
    }

    /**
     * Change the risk level of the NPC.
     *
     * @param int $amount The amount to change the risk level by.
     *
     * @return void
     */
    public function changeRiskLevel(int $amount): void
    {
        $this->riskLevel += $amount;
    }

    /**
     * Reset the risk level of the NPC.
     *
     * @return void
     */
    public function clearRiskLevel(): void
    {
        $this->riskLevel = 0;
    }

    /**
     * Steve folds
     *
     * @return array
     */
    public function setSteveFold(): array
    {
        $this->playerActions->setHasFolded();
        $this->setHand(new CardHand());
        $this->resetBest5CardHand();
        $this->clearPlayerBets();
        $this->getPlayerActions()->addToRoundActions("fold");

        return ["fold", ""];
    }

    /**
     * Steve checks
     *
     * @return array
     */
    public function setSteveCheck(): array
    {
        $this->getPlayerActions()->addToRoundActions("check");

        return ["check", ""];
    }

    /**
     * Steve calls
     *
     * @param int $amount The amount to call.
     *
     * @return array
     */
    public function setSteveCall(int $amount): array
    {
        $this->getPlayerActions()->addToRoundActions("call");
        $this->decreaseChips($amount);
        $this->addToBets($amount);

        return ["call", $amount];
    }

    /**
     * Steve raises
     *
     * @param int $amount The amount to raise.
     *
     * @return array
     */
    public function setSteveRaise(int $amount): array
    {
        $this->getPlayerActions()->addToRoundActions("raise");
        $this->decreaseChips($amount);
        $this->addToBets($amount);

        return ["raise", $amount];
    }

    /**
     * Set steve's action and get return data
     *
     * @param string $action The action to set.
     * @param int $highBet The highest bet.
     * @param int $bigBlind The big blind.
     *
     * @return array
     */
    public function setSteveActionAndReturnData(string $action, int $highBet, int $bigBlind): array
    {
        $callAmount = $highBet - $this->getBets();
        $raiseAmount = $callAmount + $bigBlind;

        switch ($action) {
            case "fold":
                $actionRes = $this->setSteveFold();
                break;
            case "check":
                $actionRes = $this->setSteveCheck();
                break;
            case "call":
                $actionRes = $this->setSteveCall($callAmount);
                break;
            case "raise":
                $actionRes = $this->setSteveRaise($raiseAmount);
                break;
            default:
                $actionRes = $this->setSteveFold();
                break;
        }

        return $actionRes;
    }

    /**
     * Set steve's action post-flop
     *
     * @param int $riskLevel The risk level of the NPC.
     * @param int $actions The amount of actions the npc can take.
     *
     * @return string
     */
    public function setSteveActionPost(int $riskLevel, int $actions): string
    {
        $action = "";

        if ($actions === 2) {
            switch (true) {
                case $riskLevel < 60:
                    $action = "check";
                    break;
                default:
                    $action = "raise";
                    break;
            }
            return $action;
        }

        switch (true) {
            case $riskLevel < 40:
                $action = "fold";
                break;
            case $riskLevel < 110:
                $action = "call";
                break;
            default:
                $action = "raise";
                break;
        }

        return $action;
    }

    /**
     * Set steve's action pre-flop
     *
     * @param int $riskLevel The risk level of the NPC.
     * @param int $actions The amount of actions the npc can take.
     *
     * @return string
     */
    public function setSteveActionPre(int $riskLevel, int $actions): string
    {
        $action = "";

        if ($actions === 2) {
            switch (true) {
                case $riskLevel < 50:
                    $action = "check";
                    break;
                default:
                    $action = "raise";
                    break;
            }
            return $action;
        }

        switch (true) {
            case $riskLevel < 30:
                $action = "fold";
                break;
            case $riskLevel < 70:
                $action = "call";
                break;
            default:
                $action = "raise";
                break;
        }

        return $action;
    }

    /**
     * Set steve's risk level
     *
     * @param PlayerInterface $human The human player.
     * @param string $stage The stage of the game.
     * @param int $pot The pot.
     * @param int $blind The big blind.
     *
     * @return int
     */
    public function setSteveRisk(PlayerInterface $human, string $stage, int $pot, int $blind): int
    {
        $actions = $human->getPlayerActions()->getRoundActions();

        $handValue = $this->getHandValue();

        $potRisk = $this->adjustRiskPotAndBlind($pot, $blind);
        $moveRisk = $this->adjustRiskPlayerActions($actions);

        $this->changeRiskLevel($potRisk);
        $this->changeRiskLevel($moveRisk);

        if ($stage === "pre") {
            return $this->getRiskLevel();
        }

        $pointRisk =  $this->adjustHandRiskPoints($handValue);

        $this->changeRiskLevel($pointRisk);

        return $this->getRiskLevel();
    }
}
