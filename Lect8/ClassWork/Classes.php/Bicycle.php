<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 6:22
 */

namespace Classes;


class Bicycle extends Vehicle
{
    const CALORIES_PER_HOUR = 500;

    public function getTravelTime(): float
    {
        return parent::getTravelTime() * 1.5;
    }

    public function getCountOfBurnedCalories(){
        return parent::getTravelTime() * self::CALORIES_PER_HOUR;
    }

}