<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 21.10.2018
 * Time: 13:35
 */
//1---------------------------
//2---------------------------
$bmv = [
    "model" => "X5",
    "speed" => "120",
    "doors" => "5",
    "year" => "2015"
    ];
//3----------------------------
$toyota = [
    "model" => "toyota toyota",
    "speed" => "150",
    "doors" => "3",
    "year" => "1990"
];

$opel = [
    "model" => "opelpopel",
    "speed" => "1",
    "doors" => "1",
    "year" => "1111"
];
//4----------------------------
foreach ($bmv as $value) {
    echo "$value - ";
}

echo "</br>";

foreach ($toyota as $value) {
    echo "$value -";
}

echo "</br>";

foreach ($opel as $value) {
    echo "$value - ";
}
echo "</br>";