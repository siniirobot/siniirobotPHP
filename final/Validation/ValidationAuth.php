<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 24.01.2019
 * Time: 8:40
 */

namespace Validation;
require_once '/study/OSPanel/domains/first/final/autoload.php';

use Databases\ActiveRecordAuth;
use Databases\DBAuth;
use\PDO;

class ValidationAuth extends ActiveRecordAuth
{
    protected $Auth;

    /**
     * ValidationAuth constructor.
     * @param $ActiveRecordAuth
     */
    public function __construct(ActiveRecordAuth $auth)
    {
        parent::__construct();
        $this->login = $auth->login;
        $this->pass = $auth->pass;
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

    /**
     * Проверяет на сощуствование такого логина в таблице.
     * @param $login
     * @return mixed
     */
    public function exist($login)
    {
        $query = DBAuth::pdo()->prepare('SELECT login FROM auth WHERE login LIKE ?');
        $query->execute([$login]);
        return $query->fetch(PDO::FETCH_ASSOC);

    }

    public function validation()
    {
        if (!$this->login) {
            echo 'Поле Введите ваш email должно быть заполенено';
            return false;
        }

        if (!$this->pass) {
            echo 'Поле Введите свой пароль должно быть заполенено';
            return false;
        }

        $login = $this->clean($this->login);

        if (!$this->checkLength($login,9,255)) {
            echo 'Ваш емэил должен быть не меньше 9 символов и не больше 255.</br>';
            return false;
        }

        if (!$this->checkLength($this->pass,6,255)) {
            echo 'Ваш пароль должен быть не меньше 6 символов и не больше 255.</br>';
            return false;
        }

        if (!filter_var($login, FILTER_VALIDATE_EMAIL)) {
            echo 'Неверный формат email.</br>';
            return false;
        }
        return $this;
    }


}