<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:45
 */

namespace Classes;


trait DiscountTrait
{
    abstract public function Test() : int;

    public function getDiscount() : int
    {
        return 10;
    }



    public function getCostWithDiscount(int $cost) : int
    {
        return $cost - ($this->getDiscount() * $cost) / 100;
    }
}