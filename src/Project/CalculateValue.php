<?php

namespace App\Project;

abstract class CalculateValue
{
    protected const VALUE_POINTS = [
        '2' => 2,
        '3' => 3,
        '4' => 4,
        '5' => 5,
        '6' => 6,
        '7' => 7,
        '8' => 8,
        '9' => 9,
        'T' => 10,
        'J' => 11,
        'Q' => 12,
        'K' => 13,
        'A' => 14,
    ];

    protected const HAND_POINTS = [
        'High Card' => 100,
        'One Pair' => 200,
        'Two Pair' => 300,
        'Three Of A Kind' => 400,
        'Straight' => 500,
        'Flush' => 600,
        'Full House' => 700,
        'Four Of A Kind' => 800,
        'Straight Flush' => 900,
    ];
}