<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.2018
 * Time: 23:02
 */

namespace Classes;

class Builder extends Workers
{
    public function __construct(string $name, float $salaryPerDay)
    {
        parent::__construct($name, $salaryPerDay);
    }
}