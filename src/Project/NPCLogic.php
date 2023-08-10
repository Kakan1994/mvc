<?php

namespace App\Project;

use App\Cards\CardHand;

/**
 * Class NPCLogic
 * 
 * This class is used to help with the NPC logic.
 */
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
     * Gets starting card values as concatenated string.
     *
     * @param array<Card> $cards The two starting cards of the npc player.
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
        $cardValue = $this->sortCards($cardValue);

        return $cardValue;
    }

    /**
     * Sorts the cards in descending order.
     *
     * @param string $cardValue The cards to sort.
     *
     * @return string The sorted cards.
     */
    public function sortCards(string $cardValue): string
    {
        $cards = str_split($cardValue);
        $count = count($cards);
        for ($i = 0; $i < $count; $i++) {
            if ($cards[$i] === "T") {
                $cards[$i] = "10";
            }elseif ($cards[$i] === "A") {
                $cards[$i] = "14";
            }elseif ($cards[$i] === "K") {
                $cards[$i] = "13";
            }elseif ($cards[$i] === "Q") {
                $cards[$i] = "12";
            }elseif ($cards[$i] === "J") {
                $cards[$i] = "11";
            }
        }
        rsort($cards);

        for ($i = 0; $i < $count; $i++) {
            if ($cards[$i] === "10") {
                $cards[$i] = "T";
            }elseif ($cards[$i] === "14") {
                $cards[$i] = "A";
            }elseif ($cards[$i] === "13") {
                $cards[$i] = "K";
            }elseif ($cards[$i] === "12") {
                $cards[$i] = "Q";
            }elseif ($cards[$i] === "11") {
                $cards[$i] = "J";
            }
        }
        
        $cardValue = implode("", $cards);
        
        return $cardValue;
    }

    /**
     * Gets starting card type.
     *
     * @param array<Card> $cards The two starting cards of the npc player.
     *
     * @return string Starting cards type.
     */
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

    /**
     * Adjusts the risk based on the starting cards rank.
     * 
     * @param int $cardRank The rank of the starting cards.
     * 
     * @return int The adjusted risk.
     */
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

    /**
     * Checks if the player has raised.
     * 
     * @param array $actions The actions of the player.
     * 
     * @return bool True if the player has raised, false otherwise.
     */
    public function hasPlayerRaised(array $actions): bool
    {
        if (in_array("raise", $actions)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the player has called.
     * 
     * @param array $actions The actions of the player.
     * 
     * @return bool True if the player has called, false otherwise.
     */
    public function hasPlayerCalled(array $actions): bool
    {
        if (in_array("call", $actions)) {
            return true;
        }

        return false;
    }

    /**
     * Checks if the player has checked.
     * 
     * @param array $actions The actions of the player.
     * 
     * @return bool True if the player has checked, false otherwise.
     */
    public function hasPlayerChecked(array $actions): bool
    {
        if (in_array("check", $actions)) {
            return true;
        }

        return false;
    }

    /**
     * Adjusts the risk based on the players actions.
     * 
     * @param array $actions The actions of the player.
     * 
     * @return int The adjusted risk.
     */
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

    /**
     * Adjusts the risk based on the pot and blind size.
     * 
     * @param int $pot The pot size.
     * @param int $blind The blind size.
     * 
     * @return int The adjusted risk.
     */
    public function adjustRiskPotAndBlind(int $pot, int $blind): int
    {
        if ($blind/$pot <= 0.1) {
            return 50;
        } elseif ($blind/$pot <= 0.3) {
            return 10;
        }

        return 0;
    }

    /**
     * Adjusts the risk based on the hand risk points.
     * 
     * @param float $points The hand risk points.
     * 
     * @return int The adjusted risk.
     */
    public function adjustHandRiskPoints(float $points): int
    {
        if ($points >= 400) {
            return 50;
        } elseif ($points >= 300) {
            return 30;
        }

        return 10;
    }

    /**
     * Wrapper for the Matt checks method.
     * 
     * @param NPCLogic $object The NPCLogic object.
     * @param PlayerInterface $player The player.
     * @param int $minRaise The minimum raise.
     * @param int $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function wrapperMattChecks(NPCLogic $object, PlayerInterface $player, int $minRaise, int $callSize): array
    {
        return $object->setMattChecks($player, $minRaise, $callSize);
    }

    /**
     * Sets the Matt checks.
     * 
     * @param PlayerInterface $player The player.
     * @param int $minRaise The minimum raise.
     * @param int $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function setMattChecks(PlayerInterface $player, int $minRaise, int $callSize): array
    {
        $player->getPlayerActions()->addToRoundActions("check");
        return ["check", ""];
    }

    /**
     * Wrapper for the Matt calls method.
     * 
     * @param NPCLogic $object The NPCLogic object.
     * @param PlayerInterface $player The player.
     * @param int $callSize The call size.
     * @param int|null $minRaise The minimum raise.
     * 
     * @return array The action and the amount.
     */
    public function wrapperMattCalls(NPCLogic $object, PlayerInterface $player, int $callSize, ?int $minRaise = null): array
    {
        return $object->setMattCalls($player, $callSize, $minRaise);
    }

    /**
     * Sets the Matt calls.
     * 
     * @param PlayerInterface $player The player.
     * @param int $callSize The call size.
     * @param int|null $minRaise The minimum raise.
     * 
     * @return array The action and the amount.
     */
    public function setMattCalls(PlayerInterface $player, int $callSize, ?int $minRaise = null): array
    {
        $player->getPlayerActions()->addToRoundActions("call");
        return ["call", $callSize];
    }

    /**
     * Wrapper for the Matt raises method.
     * 
     * @param NPCLogic $object The NPCLogic object.
     * @param PlayerInterface $player The player.
     * @param int $minRaise The minimum raise.
     * @param int $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function wrapperMattRaises(NPCLogic $object, PlayerInterface $player, int $minRaise, int $callSize): array
    {
        return $object->setMattRaises($player, $minRaise, $callSize);
    }

    /**
     * Sets the Matt raises.
     * 
     * @param PlayerInterface $player The player.
     * @param int $minRaise The minimum raise.
     * @param int $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function setMattRaises(PlayerInterface $player, int $minRaise, int $callSize): array
    {
        $player->getPlayerActions()->addToRoundActions("raise");
        return ["raise", $minRaise];
    }

    /**
     * Wrapper for the Matt folds method.
     * 
     * @param NPCLogic $object The NPCLogic object.
     * @param PlayerInterface $player The player.
     * @param int|null $minRaise The minimum raise.
     * @param int|null $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function wrapperMattFolds(NPCLogic $object, PlayerInterface $player, ?int $minRaise = null, ?int $callSize = null): array
    {
        return $object->setMattFolds($player, $minRaise, $callSize);
    }

    /**
     * Sets the Matt folds.
     * 
     * @param PlayerInterface $player The player.
     * @param int|null $minRaise The minimum raise.
     * @param int|null $callSize The call size.
     * 
     * @return array The action and the amount.
     */
    public function setMattFolds(PlayerInterface $player, ?int $minRaise = null, ?int $callSize = null): array
    {
        $player->getPlayerActions()->setHasFolded();
        $player->setHand(new CardHand);
        $player->resetBest5CardHand();
        $player->clearPlayerBets();
        $player->getPlayerActions()->addToRoundActions("fold");

        return ["fold", ""];
    }

    /**
     * Set the Matt actions.
     * 
     * @param PlayerInterface $matt The player.
     * @param int $actions The number of actions.
     * @param int $minRaise The minimum raise.
     * @param int $callSize The call size.
     * 
     * @return array The action and the amount.
     */
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