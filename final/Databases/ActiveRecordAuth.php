<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 23.01.2019
 * Time: 15:01
 */


namespace Databases;

require_once '/study/OSPanel/domains/first/final/autoload.php';

use Databases\DBAuth;
use Validation\Validation;

class ActiveRecordAuth
{
    public $login;
    public $pass;

    public function __construct()
    {
        $this->login = null;
        $this->pass = null;
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {

        $validation = new Validation($this);
        $validation = $validation->validation();

        if ($validation) {
            $query = DBAuth::pdo()->prepare('INSERT INTO auth(login,pass) VALUES (?,?)');
            $query->execute([$validation->login, $validation->pass]);
            echo 'Запись успешно добавлена.</br>';
            return true;
        } else {
            echo 'Возникла не предвидиная ошибка.</br>';
            return false;
        }
    }

    /**
     * Удаление текущего обьекта/записи.
     */
    public function delete()
    {
        $exist = new Validation($this);
        if ($exist->exist($this->login)) {
            $query = DBAuth::pdo()->prepare('DELETE FROM auth WHERE login LIKE ?');
            $query->execute([$this->login]);
            echo 'Запись удалена.</br>';
        } else {
            echo 'Такой записи не существует';
            return false;
        }
    }
}