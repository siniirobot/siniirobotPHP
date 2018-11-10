<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 10.11.2018
 * Time: 10:03
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

class Stadium
{
    protected $location;
    protected $name;
    protected $capacity;

    const TICKET_PRICE = 1230;

    public function  __construct($location,$name,$capacity)
    {
        $this->location = $location;
        $this ->capacity = $capacity;
        $this -> name = $name;
    }
    public function playMatch($team1, $team2)
    {
        return $team1 . ' 1-0 ' . $team2 . ' На матче присутсвовало '. $this ->capacity;
    }

    public static function getTicketPrice()
    {
        return self::TICKET_PRICE;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getCapacity()
    {
        return $this->capacity;
    }

    /**
     * @param mixed $capacity
     */
    public function setCapacity($capacity)
    {
        $this->capacity = $capacity;
    }

    public static function getClassName()
    {
        return __CLASS__;
    }

    public function  __toString()
    {
       return 'Hello World';
    }
}

$stadium = new Stadium('Moscow','Luzhniki', 8100000);

echo $stadium->playMatch('Россиия','Испания').'</br>';

$stadium -> setCapacity(85000000000);
echo $stadium -> getCapacity().'</br>';

echo $stadium->getTicketPrice().'</br>';

echo Stadium::getClassName().'<br>';
echo $stadium.'<br>';