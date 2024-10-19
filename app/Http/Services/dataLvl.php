<?php

namespace App\Http\Services;

class dataLvl
{
    public static $lvlRecharging = [
        0 => [
            'cost' => 0,
            'hours' => 2,
            'energy' => 7200,
            'hide' => true
        ],
        1 => [
            'cost' => 100000,
            'hours' => 4,
            'energy' => 14400
        ],
        2 => [
            'cost' => 500000,
            'hours' => 6,
            'energy' => 21600
        ],
        3 => [
            'cost' => 1000000,
            'hours' => 8,
            'energy' => 28800
        ],
        4 => [
            'cost' => 5000000,
            'hours' => 12,
            'energy' => 43200
        ],
        5 => [
            'cost' => 25000000,
            'friends' => 5,
            'hours' => 24,
            'energy' => 86400
        ],
    ];

    public static $autoBot = [
        0 => [
            'cost' => 0,
            'profitPerHour' => 0,
            'hide' => true
        ],
        1 => [
            'cost' => 250000,
            'profitPerHour' => 0.01
        ],
        2 => [
            'cost' => 500000,
            'profitPerHour' => 0.025
        ],
        3 => [
            'cost' => 1000000,
            'profitPerHour' => 0.05
        ],
        4 => [
            'cost' => 1500000,
            'profitPerHour' => 0.075
        ],
        5 => [
            'cost' => 2000000,
            'profitPerHour' => 0.1
        ],
    ];

    public static $tapLvl = [
        0 => [
            'cost' => 0,
            'multiplier' => 1,
            'hide' => true
        ],
        1 => [
            'cost' => 2500,
            'multiplier' => 1.25
        ],
        2 => [
            'cost' => 7500,
            'multiplier' => 1.5
        ],
        3 => [
            'cost' => 25000,
            'friends' => 2,
            'multiplier' => 2
        ],
        4 => [
            'cost' => 100000,
            'multiplier' => 2.5
        ],
        5 => [
            'cost' => 500000,
            'multiplier' => 3
        ],
        6 => [
            'cost' => 5000000,
            'friends' => 5,
            'multiplier' => 10
        ],
    ];
}
