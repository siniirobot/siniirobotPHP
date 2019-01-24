<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 6:49
 */
namespace Classes;

class User
{
    public $name;
    public $age;

    public function __construct($name,$age)
    {
        $this->age = $age;
        $this->name = $name;
    }

    public function isCanDriverCar(){
        if ($this->age < 18){
            throw new \Exception('Вы не можете управлять автомобилем');
        }
        return true;
    }
}