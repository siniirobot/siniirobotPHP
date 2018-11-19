<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.2018
 * Time: 12:35
 */

namespace Classes;

class Teacher extends Worker
{
    protected $experience;
    const PREMIUM = array(
        0 => 0,
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

    /**
     * Возвращает размер премии за выслугу лет.
     * @return float
     */
    public function getPremium()
    {
        $premium = null;
        foreach (self::PREMIUM as $key => $value){
            if ($this->experience >= $key) {
                $premium = $value;
            }
        }
        return (parent::getCalculateSalary() * $premium) / 100;
    }

    /**
     * Возвращает колличесвто дней переработки.
     * @return int
     */
    public function getConversion()
    {
        try {
            $workDays = parent::getWorkDays();
            if ($workDays < self::DAYS_RATE) {
                return 0;
            } else {
                return $workDays - self::DAYS_RATE;
            }
        } catch (\Exception $e) {
            echo $e->getMessage();
        }

    }

    /**
     * Возвращает зарплату учителя с учетом всех премий и переработак.
     * @return float
     */
    public function getCalculateSalary()
    {
        try {
            return parent::getCalculateSalary() + $this->getPremium() + ($this->getConversion() * $this->salaryPerDay);
        } catch (\Exception $e) {
            echo $e->getMessage();
        }
    }


}