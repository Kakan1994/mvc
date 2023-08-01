<?php

namespace App\Project;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\Card;

/**
 * Class CardHandsStraight
 *
 * This class is used to help with the poker hand comparisons.
 */
class CardHandsStraight
{
    /**
     * @param array $array The array to get combinations from.
     * @param int $length The length of the combinations.
     * @return array The combinations.
     */
    public function straightCombos(array $array, int $length): array
    {
        $size = count($array);
        if ($size < $length) {
            return [];
        }

        if ($length === 1) {
            return array_map(function ($entry) {
                return [$entry];
            }, $array);
        }

        $combos = [];

        for ($i = 0; $i <= $size - $length; $i++) {
            $head = $array[$i];
            $remaining = array_slice($array, $i + 1);
            $tailcombinations = $this->straightCombos($remaining, $length - 1);

            foreach ($tailcombinations as $combination) {
                array_unshift($combination, $head);
                $combos[] = $combination;
            }
        }

        return $combos;
    }

    /**
     * Gets the best straight from an array of possible straights.
     *
     * @param array $combos Array of possible straights.
     *
     * @return array The best straight or an empty array if no straights found.
     */
    public function getBestStraight(array $combos): array
    {
        $bestStraight = [];
        $bestStraightValue = null;

        foreach ($combos as $combination) {
            if (!$this->isStraight($combination)) {
                continue;
            }

            $highestInStraight = max($combination);
            if ($bestStraightValue === null || $highestInStraight > $bestStraightValue) {
                $bestStraightValue = $highestInStraight;
                $bestStraight = $combination;
            }
        }

        return $bestStraight;
    }

    /**
     * Checks if a combination of cards forms a straight.
     *
     * @param array $combination Combination of card values.
     *
     * @return bool Whether the combination is a straight.
     */
    public function isStraight(array $combination): bool
    {
        $count = count($combination);
        for ($i = 0; $i < $count - 1; $i++) {
            if ($combination[$i] + 1 !== $combination[$i + 1]) {
                return false;
            }
        }
        return true;
    }
}
