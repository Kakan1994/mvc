<?php

namespace App\Project;

use App\Cards\CardHand;

class NPCLogic
{
    /**
     * Checks if the player is running low on chips.
     * 
     * @param PlayerInterface $player The player to check.
     * 
     * @return bool True if the player is running low on chips, false otherwise.
     */
    public function isRunningLowOnChips(PlayerInterface $player, int $initialChips): bool
    {
        $playersChips = $player->getChips();

        if ($playersChips < ($initialChips *0.25)) {
            return true;
        }

        return false;
    }

    /**
     * Gets starting card ranks as concatenated string.
     *
     * @param array<Card> $cards The two starting cards of the computer player.
     *
     * @return string Starting cards as concatenated string.
     */
    public function getStartingCardValue(array $cards): string
    {
        $cardValue = "";

        foreach ($cards as $card) {
            if ($card->getValue() === "10") {
                $cardValue .= "T";
                continue;
            }
            $cardValue .= $card->getValue();
        }

        return $cardValue;
    }

    public function getStartingCardType(array $cards): string
    {
        $type = "o";

        if ($cards[0]->getSuit() === $cards[1]->getSuit()) {
            $type = "s";
        }elseif ($cards[0]->getValue() === $cards[1]->getValue()) {
            $type = "p";
        }

        return $type;
    }

    public function adjustCardRiskRank(int $cardRank): int
    {
        if ($cardRank <= 20) {
            return 50;
        }elseif ($cardRank <= 50) {
            return 40;
        }elseif ($cardRank <= 100) {
            return 30;
        }

        return 10;
    }

    public function hasPlayerRaised(array $actions): bool
    {
        if (in_array("raise", $actions)) {
            return true;
        }

        return false;
    }

    public function hasPlayerCalled(array $actions): bool
    {
        if (in_array("call", $actions)) {
            return true;
        }

        return false;
    }

    public function hasPlayerChecked(array $actions): bool
    {
        if (in_array("check", $actions)) {
            return true;
        }

        return false;
    }

    public function adjustRiskPlayerActions(array $actions): int
    {
        $riskAdjustment = 0;
        $hasChecked = $this->hasPlayerChecked($actions);
        $hasCalled = $this->hasPlayerCalled($actions);
        $hasRaised = $this->hasPlayerRaised($actions);

        if ($hasChecked) {
            $riskAdjustment += 30;
            if ($hasRaised) {
                $riskAdjustment -= 60;
            } elseif ($hasCalled) {
                $riskAdjustment += 50;
            }
        } elseif ($hasCalled){
            $riskAdjustment += 20;
        } elseif ($hasRaised) {
            $riskAdjustment -= 20;
        }

        return $riskAdjustment;
    }

    public function adjustHandRiskPoints(float $points): int
    {
        if ($points >= 400) {
            return 50;
        } elseif ($points >= 300) {
            return 30;
        }

        return 10;
    }

    public function wrapperMattChecks(NPCLogic $object, PlayerInterface $player, int $minRaise, int $callSize): array
    {
        return $object->setMattChecks($player, $minRaise, $callSize);
    }

    public function setMattChecks(PlayerInterface $player, int $minRaise, int $callSize): array
    {
        $player->getPlayerActions()->addToRoundActions("check");
        return ["check", ""];
    }

    public function wrapperMattCalls(NPCLogic $object, PlayerInterface $player, int $callSize, ?int $minRaise = null): array
    {
        return $object->setMattCalls($player, $minRaise, $callSize);
    }

    public function setMattCalls(PlayerInterface $player, int $callSize, ?int $minRaise = null): array
    {
        $player->getPlayerActions()->addToRoundActions("call");
        return ["call", ""];
    }

    public function wrapperMattRaises(NPCLogic $object, PlayerInterface $player, int $minRaise, int $callSize): array
    {
        return $object->setMattRaises($player, $minRaise, $callSize);
    }

    public function setMattRaises(PlayerInterface $player, int $minRaise, int $callSize): array
    {
        $player->getPlayerActions()->addToRoundActions("raise");
        return ["raise", $minRaise];
    }

    public function wrapperMattFolds(NPCLogic $object, PlayerInterface $player, int $minRaise, int $callSize): array
    {
        return $object->setMattFolds($player, $minRaise, $callSize);
    }

    public function setMattFolds(PlayerInterface $player, int $minRaise, int $callSize): array
    {
        $player->getPlayerActions()->setHasFolded();
        $player->setHand(new CardHand);
        $player->clearPlayerBets();
        $player->getPlayerActions()->addToRoundActions("fold");

        return ["fold", ""];
    }

    public function getAndSetMattAction(PlayerInterface $matt, int $actions, int $minRaise, int $callSize): array
    {
        $callMethods = ['wrapperMattCalls', 'wrapperMattRaises', 'wrapperMattFolds'];
        if ($actions === 2) {
            $callMethods = ['wrapperMattRaises', 'wrapperMattChecks'];
        }

        $method = $callMethods[ array_rand($callMethods) ];

        return $this->$method($this, $matt, $minRaise, $callSize);
    }


}