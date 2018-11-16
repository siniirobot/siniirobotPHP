<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 10.11.2018
 * Time: 10:59
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

class Userr
{
    public $name;
    public $age;
    protected $nationality;
    const ARMS = 2;
    const LEGS = 2;

    public function __construct($name, $age,$nationality)
    {
        $this->name = $name;
        $this->age = $age;
        $this->nationality = $nationality;
    }

    /**
     * @return mixed
     */
    public function getNationality()
    {
        return $this->nationality;
    }

    /**
     * @param mixed $nationality
     */
    public function setNationality($nationality)
    {
        $this->nationality = $nationality;
    }

    public function hello($name)
    {
        return 'Здравствуйте ' . $name . '. Меня зовут '. $this->name;
    }

    public function ageStatus()
    {
        if ($this->age < 1) {
            return 'Вы же младенец радуйтесь';
        } elseif ($this->age > 1 && $this->age < 18) {
            return 'Тяжко быть ребенком, а вы ребенок';
        } elseif ($this->age > 18 && $this->age < 65) {
            return 'Вы взрослый человек в рассвете сил';
        } else {
            return 'Вы пенсионер пожинайте лавры';
        }
    }

    public function  __toString()
    {
        return 'Невозможное действие';
    }
}

$pavel = new Userr('Pavel', 20,'Русский');

echo $pavel->hello('Petya').'</br>';

$pavel->name = 'Pasha';

echo $pavel->hello('Sasha').'</br>';

echo $pavel->ageStatus().'</br>';

echo $pavel->getNationality().'</br>';

$pavel->setNationality('Испанец');

echo $pavel->getNationality().'</br>';

echo $pavel.'</br>';

echo 'У меня '. $pavel::ARMS.'руки.'.'</br>';

echo 'У меня '. $pavel::LEGS.'ноги.'.'</br>';