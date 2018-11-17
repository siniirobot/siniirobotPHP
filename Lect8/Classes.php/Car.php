<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 6:37
 */

namespace Classes;

class Car extends Vehicle
{
    protected $fuel;

    public function __construct(string $brand, string $color, float $speed, int $fuel, User $user)
    {
/*        try {
            $user->isCanDriverCar();
            parent::__construct($color,$speed,$brand);
            $this ->fuel =$fuel;

        }catch (\Exception $e) {
            echo $e->getMessage();
        }*/
        if ($user ->age < 18) {
            die('Вы не можете управлять автомобилем');
        }
        parent::__construct($brand, $color, $speed);
        $this ->fuel = $fuel;
    }

    /**
     * @return int
     */
    public function getFuel(): int
    {
        return $this->fuel;
    }

    /**
     * @param int $fuel
     */
    public function setFuel(int $fuel): void
    {
        $this->fuel = $fuel;
    }

    /**
     * @return float|int
     */
    public function getFuelConsumption(){
        return ($this->getTravelTime() * $this ->fuel) / 100;
    }
}