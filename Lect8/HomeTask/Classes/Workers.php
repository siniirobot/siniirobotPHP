<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:20
 */

namespace Classes;

class Workers
{
    protected $name;
    protected $salaryPerDay;
    protected $workDay;

    public function __construct(string $name,float $salaryPerDay)
    {
        $this->name = $name;
        $this->salaryPerDay = $salaryPerDay;
    }

    /**
     * Устанавливает значение колличества отработанных дней.
     * @param $workDay
     */
    public function setWorkDay($workDay)
    {
        $this->workDay = $workDay;
    }

    /**
     * Возвращает колличесво отработаных дней и выкидывает ошибку если не было установленно
     * коллчесвто отработаных дней или дней было меньше 0
     * @return int
     * @throws \Exception
     */
    public function getWorkDay() : int
    {

        if ($this->workDay < 1) {
            throw new \Exception('Вы не указали колличество отработаных дней.'.'</br>');
        }else{
            return $this->workDay;
        }

    }

    /**
     * Возвращает зарплату за отработаные дни
     * @return float
     */
    public function getCalculateSalary() : float
    {
        try{
            return $this->salaryPerDay * $this->getWorkDay();
        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }


}