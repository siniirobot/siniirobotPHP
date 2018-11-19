<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:20
 */

namespace Classes;

class Worker
{
    protected $name;
    protected $salaryPerDay;
    protected $workDays;

    public function __construct(string $name,float $salaryPerDay)
    {
        $this->name = $name;
        $this->salaryPerDay = $salaryPerDay;
    }

    /**
     * Устанавливает значение колличества отработанных дней.
     * @param $workDays
     */
    public function setWorkDays($workDays)
    {
        $this->workDays = $workDays;
    }

    /**
     * Возвращает колличесво отработаных дней и выкидывает ошибку если не было установленно
     * коллчесвто отработаных дней или дней было меньше 0
     * @return int
     * @throws \Exception
     */
    public function getWorkDays()
    {

        if ($this->workDays < 1) {
            throw new \Exception('Вы не указали колличество отработаных дней.');
        }else{
            return $this->workDays;
        }

    }

    /**
     * Возвращает зарплату за отработаные дни
     * @return float
     */
    public function getCalculateSalary()
    {
        try{
            return $this->salaryPerDay * $this->getWorkDays();
        }catch (\Exception $e){
            echo $e->getMessage();
        }
    }
}