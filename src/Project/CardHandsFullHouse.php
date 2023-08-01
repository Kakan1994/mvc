<?php

namespace App\Project;

use App\Cards\CardHand;

class CardHandsFullHouse
{
    /**
     * @var CardHandsHelper $helper A helper class.
     */
    private $helper;

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

    public function compareCardsBySuit($aSort, $bSort): int
    {
        return $bSort->getSuit() <=> $aSort->getSuit();
    }

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

    public function getCardValues(array $cards): array
    {
        return array_map(function ($card) {
            return $this->helper->faceToNumeric($card->getValue());
        }, $cards);
    }

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

    public function findDifferentPair(array $pairs, int $chosenThree): ?int
    {
        foreach ($pairs as $pair) {
            if ($pair !== $chosenThree) {
                return $pair;
            }
        }
        return null;
    }

    public function gatherFullHouseCards(array $cards, int $chosenThree, int $chosenPair): array
    {
        return array_values(array_filter($cards, function ($card) use ($chosenThree, $chosenPair) {
            $cardValue = $this->helper->faceToNumeric($card->getValue());
            return $cardValue === $chosenThree || $cardValue === $chosenPair;
        }));
    }
}
