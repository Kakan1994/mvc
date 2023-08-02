<?php

namespace App\Project;

use App\Cards\CardHand;

class NPCSteve extends NPCMatt implements PlayerInterface
{
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

    public function getRiskLevel(): int
    {
        return $this->riskLevel;
    }

    public function changeRiskLevel(int $amount): void
    {
        $this->riskLevel += $amount;
    }

    public function clearRiskLevel(): void
    {
        $this->riskLevel = 0;
    }

    public function setSteveFold(): array
    {
        $this->playerActions->setHasFolded();
        $this->setHand(new CardHand());
        $this->clearPlayerBets();
        $this->getPlayerActions()->addToRoundActions("fold");

        return ["fold", ""];
    }

    public function setSteveCheck(): array
    {
        $this->getPlayerActions()->addToRoundActions("check");

        return ["check", ""];
    }

    public function setSteveCall(int $amount): array
    {
        $this->getPlayerActions()->addToRoundActions("call");
        $this->decreaseChips($amount);
        $this->addToBets($amount);

        return ["call", $amount];
    }

    public function setSteveRaise(int $amount): array
    {
        $this->getPlayerActions()->addToRoundActions("raise");
        $this->decreaseChips($amount);
        $this->addToBets($amount);

        return ["raise", $amount];
    }

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

    public function setSteveAction(int $riskLevel, int $actions): string
    {
        $action = "";

        if ($actions === 2){
            switch (true){
                case $riskLevel < 60:
                    $action = "check";
                    break;
                default:
                    $action = "raise";
                    break;
            }
            return $action;
        }

        switch (true){
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

    public function setSteveActionPre(int $riskLevel, int $actions): string
    {
        $action = "";

        if ($actions === 2){
            switch (true){
                case $riskLevel < 50:
                    $action = "check";
                    break;
                default:
                    $action = "raise";
                    break;
            }
            return $action;
        }
        
        switch (true){
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

    public function setSteveRisk(PlayerInterface $human, string $stage, int $pot, int $blind): int
    {
        $actions = $human->getPlayerActions()->getRoundActions();

        $handValue = $this->getHandValue();

        $potRisk = $this->adjustRiskPotAndBlind($pot, $blind);
        $moveRisk = $this->adjustRiskPlayerActions($actions);

        $this->changeRiskLevel($potRisk);
        $this->changeRiskLevel($moveRisk);

        if ($stage === "pre");
        {
            return $this->getRiskLevel();
        }

        $pointRisk =  $this->adjustRiskHandValue($handValue);

        $this->changeRiskLevel($pointRisk);

        return $this->getRiskLevel();
    }
}