<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 11.01.2019
 * Time: 10:03
 */

class Validation extends doctors
{
    protected $doctor;

    /**
     * Validation constructor.
     * @param $doctor
     */
    public function __construct(doctors $doctor)
    {
        parent::__construct();
        $this->id = $doctor->id;
        $this->lastName = $doctor->lastName;
        $this->name = $doctor->name;
        $this->phone = $doctor->phone;
        $this->salary = $doctor->salary;
        $this->receiptDate = $doctor->receiptDate;
    }

    /**
     * Удаляет пробелы из начала и конца строки.
     * Удаляет экранированные символы.
     * Удаляет HTML и PHP теги.
     * Преобразует спец символы символы.
     * @param $value
     * @return string
     */
    public function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    /**
     * Проверяет длину выражения на допустимый диапозон длины символов.
     * @param $value
     * @param $min
     * @param $max
     * @return bool
     */
    public function checkLength($value, $min, $max)
    {
        return mb_strlen($value) <= $max && mb_strlen($value) > $min;
    }

    public function validation()
    {
        if ($this->lastName != null && $this->name != null && $this->salary != null && $this->receiptDate != null) {
            $lastName = $this->clean($this->lastName);
            $name = $this->clean($this->name);
            $phone = $this->clean($this->phone);
            $salary = (float)$this->clean($this->salary);
            $receiptDate = $this->clean($this->receiptDate);
            if ($this->checkLength($lastName, 1, 255) && $this->checkLength($name, 1, 255) && $this->checkLength($phone, 12, 18)) {
                if (preg_match('/^((\+?7|8)[\s \-]?){1}((\(\d{3}\))|(\d{3})){1}([\s \-]?){1}(\d{3}[\s \-]?\d{2}[\s \-]?\d{2}){1}$/', $phone)) {
                    if (preg_match('/\d{4}-\d{2}-\d{2}/', $receiptDate)) {
                        return true;
                    } else {
                        echo 'Вы ввели не правильно дату, нужно в формате ГГГГ-ММ-ДД.</br>';
                    }
                } else {
                    echo 'Вы ввели неправильно номер телефона,нужно в формате +X-(XXX)-XXX-XX-XX.</br>';
                }
            } else {
                echo 'Вы ввели слишком длинные данные.</br>';
            }
        } else {
            echo 'Нельзя оставлять строки пустыми.</br>';
            return false;
        }
    }


}