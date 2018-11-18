<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:20
 */

//namespace Classes;

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

    public function setWorkDay($workDay)
    {
        $this->workDay = $workDay;
    }

    public function getWorkDay()
    {
        if ($this->workDay == null) {
            throw new \Exception('Вы не указали колличество отработаных дней.');
        }else{
            return $this->workDay;
        }

    }

    public function getCalculateSalary()
    {
        try{
            return $this->salaryPerDay * $this->getWorkDay();
        }catch (\Exception $e){
            echo $e->getMessage();
            return false;
        }
    }


}