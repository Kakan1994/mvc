<?php

namespace App\Game;

use App\Cards\Card;
use App\Cards\CardHand;
use App\Cards\DeckOfCards;
use App\Game\Player;
use App\Game\Dealer;

class GameScore
{
    /**
     * @var int $playerScore   The score of the player.
     */
    private $playerScore;

    /**
     * @var int $dealerScore   The score of the dealer.
     */
    private $dealerScore;

    /**
     * @var int $lastPlayerScore   The score of the player in the last round.
     */
    private $lastPlayerScore;

    /**
     * @var int $lastDealerScore   The score of the dealer in the last round.
     */
    private $lastDealerScore;

    public function __construct()
    {
        $this->playerScore = 0;
        $this->dealerScore = 0;
        $this->lastPlayerScore = 0;
        $this->lastDealerScore = 0;
    }

    /**
     * Get the score of the player.
     * @return int   The score of the player.
     */
    public function getPlayerScore(): int
    {
        return $this->playerScore;
    }

    /**
     * Set the score of the player.
     * @param int $score   The score of the player.
     */
    public function setPlayerScore(int $score): void
    {
        $this->playerScore = $score;
    }

    /**
     * Get the score of the player in the last round.
     * @return int   The score of the player in the last round.
     */
    public function getLastPlayerScore(): int
    {
        return $this->lastPlayerScore;
    }

    /**
     * Set the score of the player in the last round.
     * @param int $score   The score of the player in the last round.
     */
    public function setLastPlayerScore(int $score): void
    {
        $this->lastPlayerScore = $score;
    }

    /**
     * Get the score of the dealer.
     * @return int   The score of the dealer.
     */
    public function getDealerScore(): int
    {
        return $this->dealerScore;
    }

    /**
     * Set the score of the dealer.
     * @param int $score   The score of the dealer.
     */
    public function setDealerScore(int $score): void
    {
        $this->dealerScore = $score;
    }

    /**
     * Get the score of the dealer in the last round.
     * @return int   The score of the dealer in the last round.
     */
    public function getLastDealerScore(): int
    {
        return $this->lastDealerScore;
    }

    /**
     * Set the score of the dealer in the last round.
     * @param int $score   The score of the dealer in the last round.
     */
    public function setLastDealerScore(int $score): void
    {
        $this->lastDealerScore = $score;
    }

    /**
     * Calculate the score of a hand.
     * @param CardHand $hand   The hand to calculate the score of.
     * @return int   The score of the hand.
     */
    public function calculateScore(CardHand $hand): int
    {
        $scoreValues = [
            '1' => '1',
            '2' => '2',
            '3' => '3',
            '4' => '4',
            '5' => '5',
            '6' => '6',
            '7' => '7',
            '8' => '8',
            '9' => '9',
            '10' => '10',
            'J' => '10',
            'Q' => '10',
            'K' => '10',
            'A' => '11',
        ];
        $score = 0;
        $aces = 0;
        $cards = $hand->getCards();
        foreach ($cards as $card) {
            if ($card->getValue() === 'A') {
                $aces += 1;
            }
            $value = $card->getValue();
            $score += intval($scoreValues[$value]);
        }
        $score = $this->calcAces($score, $aces);
        return $score;
    }

    /**
     * Calculate the score of a hand with aces.
     * @param int $score   The score of the hand.
     * @param int $aces   The number of aces in the hand.
     * @return int   The score of the hand.
     */
    public function calcAces(int $score, int $aces): int
    {
        while ($aces > 0 && $score > 21) {
            $score -= 10;
            $aces -= 1;
        }
        return $score;
    }
}
