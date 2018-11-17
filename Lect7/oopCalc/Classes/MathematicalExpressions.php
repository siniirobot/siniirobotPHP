<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 15.11.2018
 * Time: 15:28
 */

class MathematicalExpressions
{
    private $file = './math.txt';

    public function addition($firstNumber, $secondNumber)
    {
        $sum = $firstNumber + $secondNumber;
        file_put_contents($this->file, $firstNumber . '+' . $secondNumber . '=' . $sum . PHP_EOL, FILE_APPEND);
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