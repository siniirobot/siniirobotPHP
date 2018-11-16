<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 15.11.2018
 * Time: 15:28
 */

class calc
{
    protected $firstNumber;
    protected $secondNumber;
    private $file;

    public function __construct($firstNumber, $secondNumber)
    {
        $this->firstNumber = $firstNumber;
        $this->secondNumber = $secondNumber;
        $this->file = 'Lect7/oopCalc/math.txt';
    }

    /**
     * @return mixed
     */
    public function getFirstNumber()
    {
        return $this->firstNumber;
    }

    /**
     * @param mixed $firstNumber
     */
    public function setFirstNumber($firstNumber)
    {
        $this->firstNumber = $firstNumber;
    }

    /**
     * @return mixed
     */
    public function getSecondNumber()
    {
        return $this->secondNumber;
    }

    /**
     * @param mixed $secondNumber
     */
    public function setSecondNumber($secondNumber)
    {
        $this->secondNumber = $secondNumber;
    }



    public function addition($firstNumber, $secondNumber)
    {
        $sum = $firstNumber + $secondNumber;
        file_put_contents($this->file, $secondNumber . '+' . $firstNumber . '=' . $sum . PHP_EOL, FILE_APPEND);
        return $sum;
    }

    public function subtraction($firstNumber, $secondNumber)
    {
        $sum = $firstNumber - $secondNumber;
        file_put_contents($this->file, $secondNumber . '-' . $firstNumber . '=' . $sum . PHP_EOL, FILE_APPEND);
        return $sum;
    }

    function multiplication($firstNumber, $secondNumber)
    {
        $sum = $firstNumber * $secondNumber;
        file_put_contents($this->file, $secondNumber . '*' . $firstNumber . '=' . $sum . PHP_EOL, FILE_APPEND);
        return $sum;
    }

    function division($firstNumber, $secondNumber)
    {
        $sum = $firstNumber / $secondNumber;
        file_put_contents($this->file, $secondNumber . '/' . $firstNumber . '=' . $sum . PHP_EOL, FILE_APPEND);
        return $sum;
    }
}