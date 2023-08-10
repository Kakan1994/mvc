<?php

namespace App\Project;

use App\Cards\Card;
use App\Cards\CardHand;

class CardHandsFullHouse
{
    /**
     * @var CardHandsHelper $helper A helper class.
     */
    private $helper;

    /**
     * CardHandsFullHouse constructor.
     */
    public function __construct()
    {
        $this->helper = new CardHandsHelper();
    }


    /**
     * Gets the full house in a hand.
     *
     * @param array $cards The cards to check.
     *
     * @return CardHand The full house or an empty array if no full house.
     */
    public function createCardHand(array $cards): CardHand
    {
        $hand = new CardHand();
        foreach ($cards as $card) {
            $hand->addCard($card);
        }
        return $hand;
    }

    /**
     * Compares two cards by face value.
     *
     * @param Card $aSort The first card.
     * @param Card $bSort The second card.
     *
     * @return int The comparison result.
     */
    public function compareCardsBySuit($aSort, $bSort): int
    {
        return $bSort->getSuit() <=> $aSort->getSuit();
    }

    /**
     * Filter the full house cards.
     *
     * @param array $fullHouseCards The full house cards.
     * @param int $chosenThree The chosen three.
     * @param int $chosenPair The chosen pair.
     *
     * @return array The filtered full house cards.
     */
    public function filterFullHouseCards(array $fullHouseCards, int $chosenThree, int $chosenPair): array
    {
        if (count($fullHouseCards) <= 5) {
            return $fullHouseCards;
        }

        $threeCards = array_filter($fullHouseCards, function ($card) use ($chosenThree) {
            return $this->helper->faceToNumeric($card->getValue()) === $chosenThree;
        });

        $pairCards = array_filter($fullHouseCards, function ($card) use ($chosenPair) {
            return $this->helper->faceToNumeric($card->getValue()) === $chosenPair;
        });

        usort($threeCards, [$this, 'compareCardsBySuit']);
        usort($pairCards, [$this, 'compareCardsBySuit']);

        return array_merge(array_slice($threeCards, 0, 3), array_slice($pairCards, 0, 2));
    }

    /**
     * Converts the face values to numeric values. For example, "A" to 14.
     *
     * @param array $cards The cards to convert.
     *
     * @return array The converted cards.
     */
    public function getCardValues(array $cards): array
    {
        return array_map(function ($card) {
            return $this->helper->faceToNumeric($card->getValue());
        }, $cards);
    }

    /**
     * Finds if the cards sent in is three or more or pair.
     *
     * @param array $counts The counts of the cards.
     *
     * @return array The three or more and pairs.
     */
    public function findThreeOrMoreAndPairs(array $counts): array
    {
        $threeOrMore = [];
        $pairs = [];

        foreach ($counts as $value => $count) {
            if ($count >= 3) {
                $threeOrMore[] = $value;
            }
            if ($count >= 2) {
                $pairs[] = $value;
            }
        }

        return [$threeOrMore, $pairs];
    }

    /**
     * Find pairs that's not the chosen three.
     *
     * @param array $pairs The pairs.
     * @param int $chosenThree The chosen three.
     *
     * @return int|null The pair that's not the chosen three.
     */
    public function findDifferentPair(array $pairs, int $chosenThree): ?int
    {
        foreach ($pairs as $pair) {
            if ($pair !== $chosenThree) {
                return $pair;
            }
        }
        return null;
    }

    /**
     * Find the full house cards.
     *
     * @param array $cards The cards to check.
     * @param int $chosenThree The chosen three.
     * @param int $chosenPair The chosen pair.
     *
     * @return array The full house cards.
     */
    public function gatherFullHouseCards(array $cards, int $chosenThree, int $chosenPair): array
    {
        return array_values(array_filter($cards, function ($card) use ($chosenThree, $chosenPair) {
            $cardValue = $this->helper->faceToNumeric($card->getValue());
            return $cardValue === $chosenThree || $cardValue === $chosenPair;
        }));
    }
}
