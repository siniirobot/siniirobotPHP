<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.2018
 * Time: 12:35
 */

namespace Classes;

class Teacher extends Workers
{
    protected $experience;
    const PREMIUM = array(
        3 => 3,
        5 => 5,
        10 => 15,
        20 => 30,
        30 => 50,
    );
    const CONVERSION = 10;
    const DAYS_RATE = 25;

    public function __construct(string $name, float $salaryPerDay, int $experience)
    {
        parent::__construct($name, $salaryPerDay);
        $this->experience = $experience;
    }

    public function isItPremiumYear() : bool
    {
        if (array_key_exists($this->experience, self::PREMIUM))
        {
            return true;
        } else {
            throw new \Exception('Премия будет в другой год');
        }
    }

    public function getPremium() : float
    {
        try {
            if ($this->isItPremiumYear()) {
                return (parent::getCalculateSalary() * self::PREMIUM[$this->experience]) / 100;
            }
        } catch (\Exception $e) {
            echo $e->getMessage().'в классе Teacher функции getPremium'.'</br>';
            return 0;
        }
    }

    public function getConversion() : int
    {
        try{
            $workDay = parent::getWorkDay();
            if ($workDay < self::DAYS_RATE) {
                return 0;
            }else {
                return $workDay - self::DAYS_RATE;
            }
        }catch (\Exception $e){
            echo $e->getMessage().' в классе Teacher функции getConversion'.'</br>';
            return 0;
        }

    }

    public function getCalculateSalary() : float
    {
        try{
            return parent::getCalculateSalary() + $this->getPremium() + ($this->getConversion() * $this->salaryPerDay);
        }catch (\Exception $e){
            echo $e->getMessage().' в классе Teacher функции getCalculateSalary'.'</br>';
        }

    }


}