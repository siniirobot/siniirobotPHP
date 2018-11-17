<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 6:07
 */

namespace Classes;

class Vehicle
{
    protected $color;
    protected $speed;
    protected $brand;
    protected $distance;

    public function __construct(string $brand,string $color,float $speed)
    {
        $this->brand = $brand;
        $this->color = $color;
        $this->speed = $speed;
    }


    /**
     * @return mixed
     */
    public function getSpeed() : float
    {
        return $this->speed;
    }

    /**
     * @param mixed $speed
     */
    public function setSpeed($speed)
    {
        $this->speed = $speed;
    }

    /**
     * @return mixed
     */
    public function getDistance()
    {
        return $this->distance;
    }

    /**
     * @param mixed $distance
     */
    public function setDistance(int $distance)
    {
        $this->distance = $distance;
    }

    public function getTravelTime() : float
    {
        return $this->getDistance() / $this->getSpeed();
    }

}