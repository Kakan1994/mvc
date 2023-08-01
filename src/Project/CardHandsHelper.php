<?php

namespace App\Project;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\Card;

/**
 * Class CardHandsHelper
 *
 * This class is used to help with the poker hand comparisons.
 */
class CardHandsHelper
{
    /**
     * @param string $value The value of the card.
     * @return int The numerical value of the card.
     */
    public function faceToNumeric($value): int
    {
        if ($value === 'A') {
            return 14;
        } elseif ($value === 'K') {
            return 13;
        } elseif ($value === 'Q') {
            return 12;
        } elseif ($value === 'J') {
            return 11;
        }
        return (int)$value;

    }

    /**
     * @param string $value The value of the card.
     * @return int The numerical value of the card.
     */
    public function faceToNumericAceLow($value): int
    {
        if ($value === 'A') {
            return 1;
        } elseif ($value === 'K') {
            return 13;
        } elseif ($value === 'Q') {
            return 12;
        } elseif ($value === 'J') {
            return 11;
        }
        return (int)$value;
    }

    /**
     * @param int $value The numerical value of the card.
     * @return string The value of the card.
     */
    public function numericToFace($value): string
    {
        if ($value === 14 || $value === 1) {
            return 'A';
        } elseif ($value === 13) {
            return 'K';
        } elseif ($value === 12) {
            return 'Q';
        } elseif ($value === 11) {
            return 'J';
        }
        return (string)$value;
    }

    /**
     * Counts the occurrences of each card in a hand.
     *
     * @param CardHand $hand The hand to count.
     *
     * @return array An associative array with card values as keys and their counts as values.
     */
    public function getCardCounts(CardHand $hand): array
    {
        $values = array_map(function ($card) {
            return $card->getValue();
        }, $hand->getCards());

        return array_count_values($values);
    }

    /**
     * Converts face card values to numeric.
     *
     * @param array $values The card values to convert.
     *
     * @return array The converted values.
     */
    public function faceValuesToNumeric(array $values): array
    {
        return array_map(function ($value) {
            return $this->faceToNumeric($value);
        }, $values);
    }

    /**
     * Converts face card values to numeric.
     *
     * @param array $values The card values to convert.
     *
     * @return array The converted values.
     */
    public function faceValuesToNumericAceLow(array $values): array
    {
        return array_map(function ($value) {
            return $this->faceToNumericAceLow($value);
        }, $values);
    }

    /**
     * Creates a hand that only includes cards with certain values.
     *
     * @param CardHand $hand   The original hand.
     * @param array    $values The values to include.
     *
     * @return CardHand The new hand.
     */
    public function createHandWithValues(CardHand $hand, array $values): CardHand
    {
        $newHand = new CardHand();
        $cards = $hand->getCards();

        foreach ($cards as $card) {
            if (in_array($card->getValue(), $values, true)) {
                $newHand->addCard($card);
            }
        }

        return $newHand;
    }

    /**
     * Get the numeric values of cards in a hand.
     *
     * @param CardHand $hand The hand.
     *
     * @return array Numeric values of the cards.
     */
    public function getCardNumericValues(CardHand $hand): array
    {
        $values = array_map(function ($card) {
            return $card->getValue();
        }, $hand->getCards());

        return $this->faceValuesToNumeric($values);
    }

    public function getCardNumericValuesAceLow(CardHand $hand): array
    {
        $values = array_map(function ($card) {
            return $card->getValue();
        }, $hand->getCards());

        return $this->faceValuesToNumericAceLow($values);
    }

    /**
     * Converts numeric values to face card values.
     *
     * @param array $values The numeric values.
     *
     * @return array The face card values.
     */
    public function numericValuesToFace(array $values): array
    {
        return array_map(function ($value) {
            return $this->numericToFace($value);
        }, $values);
    }

    /**
     * Creates a hand that only includes cards with a certain suit.
     *
     * @param CardHand $hand The original hand.
     * @param string   $suit The suit to include.
     *
     * @return CardHand The new hand.
     */
    public function createHandWithSuit(CardHand $hand, string $suit): CardHand
    {
        $newHand = new CardHand();
        $cards = $hand->getCards();

        foreach ($cards as $card) {
            if ($card->getSuit() === $suit) {
                $newHand->addCard($card);
            }
        }

        return $newHand;
    }
}
