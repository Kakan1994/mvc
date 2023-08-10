<?php

namespace App\Project;

class PreFlop
{
    /**
     * @var string $rankings The JSON string representing the rankings of the pre-flop hands.
     */
    private $rankings = '[
        {"ranks": "1", "cards": "AA", "type": "p"},
        {"ranks": "2", "cards": "KK", "type": "p"},
        {"ranks": "3", "cards": "QQ", "type": "p"},
        {"ranks": "4", "cards": "AK", "type": "s"},
        {"ranks": "5", "cards": "JJ", "type": "p"},
        {"ranks": "6", "cards": "AQ", "type": "s"},
        {"ranks": "7", "cards": "KQ", "type": "s"},
        {"ranks": "8", "cards": "AJ", "type": "s"},
        {"ranks": "9", "cards": "KJ", "type": "s"},
        {"ranks": "10", "cards": "TT", "type": "p"},
        {"ranks": "11", "cards": "AK", "type": "o"},
        {"ranks": "12", "cards": "AT", "type": "s"},
        {"ranks": "13", "cards": "QJ", "type": "s"},
        {"ranks": "14", "cards": "KT", "type": "s"},
        {"ranks": "15", "cards": "QT", "type": "s"},
        {"ranks": "16", "cards": "JT", "type": "s"},
        {"ranks": "17", "cards": "99", "type": "p"},
        {"ranks": "18", "cards": "AQ", "type": "o"},
        {"ranks": "19", "cards": "A9", "type": "s"},
        {"ranks": "20", "cards": "KQ", "type": "o"},
        {"ranks": "21", "cards": "88", "type": "p"},
        {"ranks": "22", "cards": "K9", "type": "s"},
        {"ranks": "23", "cards": "T9", "type": "s"},
        {"ranks": "24", "cards": "A8", "type": "s"},
        {"ranks": "25", "cards": "Q9", "type": "s"},
        {"ranks": "26", "cards": "J9", "type": "s"},
        {"ranks": "27", "cards": "AJ", "type": "o"},
        {"ranks": "28", "cards": "A5", "type": "s"},
        {"ranks": "29", "cards": "77", "type": "p"},
        {"ranks": "30", "cards": "A7", "type": "s"},
        {"ranks": "31", "cards": "KJ", "type": "o"},
        {"ranks": "32", "cards": "A4", "type": "s"},
        {"ranks": "33", "cards": "A3", "type": "s"},
        {"ranks": "34", "cards": "A6", "type": "s"},
        {"ranks": "35", "cards": "QJ", "type": "o"},
        {"ranks": "36", "cards": "66", "type": "p"},
        {"ranks": "37", "cards": "K8", "type": "s"},
        {"ranks": "38", "cards": "T8", "type": "s"},
        {"ranks": "39", "cards": "A2", "type": "s"},
        {"ranks": "40", "cards": "98", "type": "s"},
        {"ranks": "41", "cards": "J8", "type": "s"},
        {"ranks": "42", "cards": "AT", "type": "o"},
        {"ranks": "43", "cards": "Q8", "type": "s"},
        {"ranks": "44", "cards": "K7", "type": "s"},
        {"ranks": "45", "cards": "KT", "type": "o"},
        {"ranks": "46", "cards": "55", "type": "p"},
        {"ranks": "47", "cards": "JT", "type": "o"},
        {"ranks": "48", "cards": "87", "type": "s"},
        {"ranks": "49", "cards": "QT", "type": "o"},
        {"ranks": "50", "cards": "44", "type": "p"},
        {"ranks": "51", "cards": "33", "type": "p"},
        {"ranks": "52", "cards": "22", "type": "p"},
        {"ranks": "53", "cards": "K6", "type": "s"},
        {"ranks": "54", "cards": "97", "type": "s"},
        {"ranks": "55", "cards": "K5", "type": "s"},
        {"ranks": "56", "cards": "76", "type": "s"},
        {"ranks": "57", "cards": "T7", "type": "s"},
        {"ranks": "58", "cards": "K4", "type": "s"},
        {"ranks": "59", "cards": "K3", "type": "s"},
        {"ranks": "60", "cards": "K2", "type": "s"},
        {"ranks": "61", "cards": "Q7", "type": "s"},
        {"ranks": "62", "cards": "86", "type": "s"},
        {"ranks": "63", "cards": "65", "type": "s"},
        {"ranks": "64", "cards": "J7", "type": "s"},
        {"ranks": "65", "cards": "54", "type": "s"},
        {"ranks": "66", "cards": "Q6", "type": "s"},
        {"ranks": "67", "cards": "75", "type": "s"},
        {"ranks": "68", "cards": "96", "type": "s"},
        {"ranks": "69", "cards": "Q5", "type": "s"},
        {"ranks": "70", "cards": "64", "type": "s"},
        {"ranks": "71", "cards": "Q4", "type": "s"},
        {"ranks": "72", "cards": "Q3", "type": "s"},
        {"ranks": "73", "cards": "T9", "type": "o"},
        {"ranks": "74", "cards": "T6", "type": "s"},
        {"ranks": "75", "cards": "Q2", "type": "s"},
        {"ranks": "76", "cards": "A9", "type": "o"},
        {"ranks": "77", "cards": "53", "type": "s"},
        {"ranks": "78", "cards": "85", "type": "s"},
        {"ranks": "79", "cards": "J6", "type": "s"},
        {"ranks": "80", "cards": "J9", "type": "o"},
        {"ranks": "81", "cards": "K9", "type": "o"},
        {"ranks": "82", "cards": "J5", "type": "s"},
        {"ranks": "83", "cards": "Q9", "type": "o"},
        {"ranks": "84", "cards": "43", "type": "s"},
        {"ranks": "85", "cards": "74", "type": "s"},
        {"ranks": "86", "cards": "J4", "type": "s"},
        {"ranks": "87", "cards": "J3", "type": "s"},
        {"ranks": "88", "cards": "95", "type": "s"},
        {"ranks": "89", "cards": "J2", "type": "s"},
        {"ranks": "90", "cards": "63", "type": "s"},
        {"ranks": "91", "cards": "A8", "type": "o"},
        {"ranks": "92", "cards": "52", "type": "s"},
        {"ranks": "93", "cards": "T5", "type": "s"},
        {"ranks": "94", "cards": "84", "type": "s"},
        {"ranks": "95", "cards": "T4", "type": "s"},
        {"ranks": "96", "cards": "T3", "type": "s"},
        {"ranks": "97", "cards": "42", "type": "s"},
        {"ranks": "98", "cards": "T2", "type": "s"},
        {"ranks": "99", "cards": "98", "type": "o"},
        {"ranks": "100", "cards": "T8", "type": "o"},
        {"ranks": "101", "cards": "A5", "type": "o"},
        {"ranks": "102", "cards": "A7", "type": "o"},
        {"ranks": "103", "cards": "73", "type": "s"},
        {"ranks": "104", "cards": "A4", "type": "o"},
        {"ranks": "105", "cards": "32", "type": "s"},
        {"ranks": "106", "cards": "94", "type": "s"},
        {"ranks": "107", "cards": "93", "type": "s"},
        {"ranks": "108", "cards": "J8", "type": "o"},
        {"ranks": "109", "cards": "A3", "type": "o"},
        {"ranks": "110", "cards": "62", "type": "s"},
        {"ranks": "111", "cards": "92", "type": "s"},
        {"ranks": "112", "cards": "K8", "type": "o"},
        {"ranks": "113", "cards": "A6", "type": "o"},
        {"ranks": "114", "cards": "87", "type": "o"},
        {"ranks": "115", "cards": "Q8", "type": "o"},
        {"ranks": "116", "cards": "83", "type": "s"},
        {"ranks": "117", "cards": "A2", "type": "o"},
        {"ranks": "118", "cards": "82", "type": "s"},
        {"ranks": "119", "cards": "97", "type": "o"},
        {"ranks": "120", "cards": "72", "type": "s"},
        {"ranks": "121", "cards": "76", "type": "o"},
        {"ranks": "122", "cards": "K7", "type": "o"},
        {"ranks": "123", "cards": "65", "type": "o"},
        {"ranks": "124", "cards": "T7", "type": "o"},
        {"ranks": "125", "cards": "K6", "type": "o"},
        {"ranks": "126", "cards": "86", "type": "o"},
        {"ranks": "127", "cards": "54", "type": "o"},
        {"ranks": "128", "cards": "K5", "type": "o"},
        {"ranks": "129", "cards": "J7", "type": "o"},
        {"ranks": "130", "cards": "75", "type": "o"},
        {"ranks": "131", "cards": "Q7", "type": "o"},
        {"ranks": "132", "cards": "K4", "type": "o"},
        {"ranks": "133", "cards": "K3", "type": "o"},
        {"ranks": "134", "cards": "96", "type": "o"},
        {"ranks": "135", "cards": "K2", "type": "o"},
        {"ranks": "136", "cards": "64", "type": "o"},
        {"ranks": "137", "cards": "Q6", "type": "o"},
        {"ranks": "138", "cards": "85", "type": "o"},
        {"ranks": "139", "cards": "J6", "type": "o"},
        {"ranks": "140", "cards": "Q5", "type": "o"},
        {"ranks": "141", "cards": "74", "type": "o"},
        {"ranks": "142", "cards": "Q4", "type": "o"},
        {"ranks": "143", "cards": "Q3", "type": "o"},
        {"ranks": "144", "cards": "95", "type": "o"},
        {"ranks": "145", "cards": "53", "type": "o"},
        {"ranks": "146", "cards": "Q2", "type": "o"},
        {"ranks": "147", "cards": "43", "type": "o"},
        {"ranks": "148", "cards": "63", "type": "o"},
        {"ranks": "149", "cards": "52", "type": "o"},
        {"ranks": "150", "cards": "84", "type": "o"},
        {"ranks": "151", "cards": "42", "type": "o"},
        {"ranks": "152", "cards": "J5", "type": "o"},
        {"ranks": "153", "cards": "32", "type": "o"},
        {"ranks": "154", "cards": "73", "type": "o"},
        {"ranks": "155", "cards": "94", "type": "o"},
        {"ranks": "156", "cards": "93", "type": "o"},
        {"ranks": "157", "cards": "J4", "type": "o"},
        {"ranks": "158", "cards": "62", "type": "o"},
        {"ranks": "159", "cards": "J3", "type": "o"},
        {"ranks": "160", "cards": "92", "type": "o"},
        {"ranks": "161", "cards": "J2", "type": "o"},
        {"ranks": "162", "cards": "83", "type": "o"},
        {"ranks": "163", "cards": "82", "type": "o"},
        {"ranks": "164", "cards": "T6", "type": "o"},
        {"ranks": "165", "cards": "72", "type": "o"},
        {"ranks": "166", "cards": "T5", "type": "o"},
        {"ranks": "167", "cards": "T4", "type": "o"},
        {"ranks": "168", "cards": "T3", "type": "o"},
        {"ranks": "169", "cards": "T2", "type": "o"}
    ]';

    /**
     * @var array $rankingsArray Array of all possible pre-flop hands
     */
    private $rankingsArray;

    /**
     * PreFlop constructor.
     */
    public function __construct()
    {
        $this->rankingsArray = json_decode($this->rankings);
    }

    /**
     * Get the rankings as array
     * 
     * @return array $rankingsArray Array of all possible pre-flop hands
     */
    public function getRankingsArray(): array
    {
        return $this->rankingsArray;
    }

    /**
     * Get the ranks of a hand by cards and type
     * 
     * @param string $cards Cards of the hand
     * @param string $type Type of the hand
     * 
     * @return string $ranks Ranks of the hand
     */
    public function getHandByCardsAndType(string $cards, string $type)
    {
        foreach ($this->rankingsArray as $key => $value) {
            if ($value->cards === $cards && $value->type === $type) {
                return $value->ranks;
            }
        }
    }

    /**
     * Covert cards from object to string array
     * 
     * @param array $cards Cards to convert
     * 
     * @return array $cardArray Converted cards
     */
    public function turnCardsIntoStringArray(array $cards): array
    {
        $cardArray = [];

        foreach ($cards as $card) {
            $value = $card->getValue();
            if ($value === "10") {
                $value = "T";
            }
            $suit = $card->getSuit();
            switch ($suit) {
                case "♥":
                    $suit = "H";
                    break;
                case "♠":
                    $suit = "S";
                    break;
                case "♦":
                    $suit = "D";
                    break;
                case "♣":
                    $suit = "C";
                    break;
            }
            $cardArray[] = $value . $suit;
        }

        return $cardArray;
    }

}

