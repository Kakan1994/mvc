<?php

namespace App\Project;

use App\Cards\CardHand;

class CardHandsFlush
{
    /**
     * Gets the suit of the flush in a hand.
     *
     * @param CardHand $hand The hand to check.
     *
     * @return string|null The suit of the flush or null if no flush.
     */
    public function getFlushSuit(CardHand $hand): ?string
    {
        $suits = array_map(function ($card) {
            return $card->getSuit();
        }, $hand->getCards());

        $counts = array_count_values($suits);
        $flushSuit = array_search(max($counts), $counts, true);

        return $counts[$flushSuit] >= 5 ? $flushSuit : null;
    }
}
