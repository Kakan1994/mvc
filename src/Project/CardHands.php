<?php

namespace App\Project;

use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Cards\Card;

/**
 * Class CardHands
 *
 * Represents the diffrent possible hands in Texas Hold'em.
 */
class CardHands
{
    /**
     * @var CardHandsHelper $helper   The helper class.
     */
    private $helper;

    /**
     * @var CardHandsStraight $straight   The straight class.
     */
    private $straight;

    /**
     * @var CardHandsFlush $flush   The flush class.
     */
    private $flush;

    /**
     * @var CardHandsFullHouse $fullHouse   The full house class.
     */
    private $house;

    /**
     * CardHands constructor.
     */
    public function __construct()
    {
        $this->helper = new CardHandsHelper();
        $this->straight = new CardHandsStraight();
        $this->flush = new CardHandsFlush();
        $this->house = new CardHandsFullHouse();
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return string|int The best hand in the hand.
     */
    public function checkBestHand(CardHand $hand): string|int
    {
        $handChecks = [
            'checkStraightFlush' => 9,
            'checkFourOfAKind' => 8,
            'checkFullHouse' => 7,
            'checkFlush' => 6,
            'checkStraight' => 5,
            'checkThreeOfAKind' => 4,
            'check2Pair' => 3,
            'checkPair' => 2
        ];

        foreach ($handChecks as $check => $value) {
            $bestHand = $this->$check($hand);
            if ($bestHand instanceof CardHand && !$bestHand->isEmpty()) {
                return $value;
            }
        }

        return 1;
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return Card The highest card in the hand.
     */
    public function checkHighCardAceHigh(CardHand $hand): Card
    {
        $cards = $hand->getCards();
        $highCard = null;
        $highValue = 0;

        foreach ($cards as $card) {
            $value = $card->getValue();

            // convert face cards and ace to numerical values
            $numValue = $this->helper->faceToNumeric($value);

            // if this card's value is higher than the current highest, update the highest
            if ($numValue > $highValue) {
                $highValue = $numValue;
                $highCard = $card;
            }
        }
        if ($highCard === null) {
            return new Card('♥', 'A');
        }
        return $highCard;
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return Card The highest card in the hand.
     */
    public function checkHighCardAceLow(CardHand $hand): Card
    {
        $cards = $hand->getCards();
        $highCard = null;
        $highValue = 0;

        foreach ($cards as $card) {
            $value = $card->getValue();

            // convert face cards and ace to numerical values
            $numValue = $this->helper->faceToNumericAceLow($value);

            // if this card's value is higher than the current highest, update the highest
            if ($numValue > $highValue) {
                $highValue = $numValue;
                $highCard = $card;
            }
        }
        if ($highCard === null) {
            return new Card('♥', 'K');
        }
        return $highCard;
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The higest pair in the hand.
     */
    public function checkPair(CardHand $hand): CardHand
    {
        $counts = $this->helper->getCardCounts($hand);

        $pairValues = array_keys($counts, 2);

        if (empty($pairValues)) {
            return new CardHand(); // No pair found.
        }

        $pairValues = $this->helper->faceValuesToNumeric($pairValues);

        // sort descending to get the highest pair
        rsort($pairValues);

        $highPairValue = $this->helper->numericToFace($pairValues[0]);

        return $this->helper->createHandWithValues($hand, [$highPairValue]);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The highest two pairs in the hand, if they exist.
     */
    public function check2Pair(CardHand $hand): CardHand
    {
        $counts = $this->helper->getCardCounts($hand);

        $pairValues = array_keys($counts, 2);

        if (count($pairValues) < 2) {
            return new CardHand(); // No two pairs found.
        }

        $pairValues = $this->helper->faceValuesToNumeric($pairValues);

        // sort descending to get the highest pairs
        rsort($pairValues);

        $highPairValues = array_map([$this->helper, 'numericToFace'], array_slice($pairValues, 0, 2));

        return $this->helper->createHandWithValues($hand, $highPairValues);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The higest 3 of a kind in the hand.
     */
    public function checkThreeOfAKind(CardHand $hand): CardHand
    {
        $counts = $this->helper->getCardCounts($hand);

        $threeOfKindValues = array_keys($counts, 3);

        if (empty($threeOfKindValues)) {
            return new CardHand(); // No three-of-a-kind found.
        }

        $threeOfKindValues = $this->helper->faceValuesToNumeric($threeOfKindValues);

        // sort descending to get the highest
        rsort($threeOfKindValues);

        // get the highest
        $high3OfKindValue = $this->helper->numericToFace($threeOfKindValues[0]);

        return $this->helper->createHandWithValues($hand, [$high3OfKindValue]);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best straight in the hand.
     */
    public function checkStraightAceLow(CardHand $hand): CardHand
    {
        $values = $this->helper->getCardNumericValuesAceLow($hand);

        sort($values);

        $straightCombos = $this->straight->straightCombos($values, 5);

        $bestStraight = $this->straight->getBestStraight($straightCombos);

        if (empty($bestStraight)) {
            return new CardHand(); // No straight found.
        }

        $bestStraight = $this->helper->numericValuesToFace($bestStraight);

        return $this->helper->createHandWithValues($hand, $bestStraight);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best straight in the hand.
     */
    public function checkStraightAceHigh(CardHand $hand): CardHand
    {
        $values = $this->helper->getCardNumericValues($hand);

        sort($values);

        $straightCombos = $this->straight->straightCombos($values, 5);

        $bestStraight = $this->straight->getBestStraight($straightCombos);

        if (empty($bestStraight)) {
            return new CardHand(); // No straight found.
        }

        $bestStraight = $this->helper->numericValuesToFace($bestStraight);

        return $this->helper->createHandWithValues($hand, $bestStraight);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best straight in the hand.
     * @return array The higest 3 of a kind in the hand
     * @return Card The highest card in the hand.
     */
    public function checkStraight(CardHand $hand): CardHand|array|Card
    {
        if (count($hand->getCards()) < 5) {
            return $this->checkThreeOfAKind($hand);
        }
        $straightAceHigh = $this->checkStraightAceHigh($hand);
        if (!$straightAceHigh->isEmpty()) {
            return $straightAceHigh;
        }
        $straightAceLow = $this->checkStraightAceLow($hand);
        return $straightAceLow;
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best flush in the hand.
     */
    public function checkFlush(CardHand $hand): CardHand
    {
        if (count($hand->getCards()) < 5) {
            return new CardHand(); // Not enough cards for a flush.
        }

        $flushSuit = $this->flush->getFlushSuit($hand);

        if ($flushSuit === null) {
            return new CardHand(); // No flush found.
        }

        return $this->helper->createHandWithSuit($hand, $flushSuit);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best full house in the hand.
     */
    public function checkFullHouse(CardHand $hand): CardHand
    {
        $cards = $hand->getCards();

        if (count($cards) < 5) {
            return new CardHand(); // Not enough cards for a full house.
        }

        $values = $this->house->getCardValues($cards);

        $counts = array_count_values($values);
        arsort($counts); // sort in descending order to start checking from the highest count

        list($threeOrMore, $pairs) = $this->house->findThreeOrMoreAndPairs($counts);

        // Sort in descending order to get the highest
        rsort($threeOrMore);
        rsort($pairs);

        // Choose a three of a kind
        $chosenThree = array_shift($threeOrMore);
        if ($chosenThree === null) {
            return new CardHand(); // no full house
        }

        // Choose a pair that is different from the chosenThree
        $chosenPair = $this->house->findDifferentPair($pairs, $chosenThree);
        if ($chosenPair === null) {
            return new CardHand(); // no full house
        }

        // Gather full house cards
        $fullHouseCards = $this->house->gatherFullHouseCards($cards, $chosenThree, $chosenPair);

        // If there are more than 5 cards, only include the 3 highest cards of the three-of-a-kind and the 2 highest of the pair
        $fullHouseCards = $this->house->filterFullHouseCards($fullHouseCards, $chosenThree, $chosenPair);

        return $this->house->createCardHand($fullHouseCards);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best four of a kind in the hand.
     */
    public function checkFourOfAKind(CardHand $hand): CardHand
    {
        $counts = $this->helper->getCardCounts($hand);

        $fourOfKindValues = array_keys($counts, 4);

        if (empty($fourOfKindValues)) {
            return new CardHand(); // No four-of-a-kind found.
        }

        $fourOfKindValues = $this->helper->faceValuesToNumeric($fourOfKindValues);

        // sort descending to get the highest
        rsort($fourOfKindValues);

        // get the highest
        $high4OfKindValue = $this->helper->numericToFace($fourOfKindValues[0]);

        return $this->helper->createHandWithValues($hand, [$high4OfKindValue]);
    }

    /**
     * @param CardHand $hand The hand to check.
     * @return CardHand The best straight flush in the hand.
     */
    public function checkStraightFlush(CardHand $hand): Cardhand
    {
        $cards = $hand->getCards();
        if (count($cards) < 5) {
            return new cardHand(); // Not enough cards for a straight flush.
        }
        $straightHand = $this->checkStraight($hand);
        if ($straightHand instanceof CardHand && $straightHand->isEmpty()) {
            return $straightHand; // No straight found.
        }
        $flushHand = $this->checkFlush($straightHand);

        if ($flushHand instanceof CardHand && !$flushHand->isEmpty()) {
            return $flushHand;  // Straight flush found.
        }

        return new cardHand(); // Straight found but no flush.
    }
}
