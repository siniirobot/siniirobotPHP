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
use Validation\ValidationAuth;
use \PDO;

class ActiveRecordAuth
{
    public $id;
    public $login;
    public $pass;

    public function __construct()
    {
        $this->id = null;
        $this->login = null;
        $this->pass = null;
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {
        $validation = new ValidationAuth($this);
        $validation = $validation->validation();

        if ($validation->exist($validation->login)) {
            echo 'Такой пользователь уже сущесвтует.</br>';
            return false;
        }

        if ($validation) {
            $query = DBAuth::pdo()->prepare('INSERT INTO auth(login,pass) VALUES (?,?)');
            $query->execute([$validation->login, $validation->pass]);
            echo 'Запись успешно создана.</br>';
            return true;
        } else {
            echo 'При создании записи возникла ошибка.</br>';
            return false;
        }
    }

    /**
     * Удаление текущего обьекта/записи.
     */
    public function delete()
    {
        $exist = new ValidationAuth($this);
        if ($exist->exist($this->login)) {
            $query = DBAuth::pdo()->prepare('DELETE FROM auth WHERE login LIKE ?');
            $query->execute([$this->login]);
            echo 'Запись удалена.</br>';
        } else {
            echo 'Чтобы удалить эту запись она должна существовать.</br>';
            return false;
        }
    }

    /**
     * Создание обьекта с такими же данными как и у последней записи в таблице.
     */
    public function read()
    {
        $query = DBAuth::pdo()->prepare('SELECT * FROM auth ORDER BY id DESC LIMIT 1');
        $query->execute();
        if ($query->rowCount()) {
            $lastRow = $query->fetch(PDO::FETCH_ASSOC);
            $this->id = $lastRow['id'];
            $this->login = $lastRow['login'];
            $this->pass = $lastRow['pass'];
            echo 'Запись прочитана.</br>';
        } else {
            echo 'Скорее всего таблица пуста' . '</br>';
        }
    }

    /**
     * Обновление текущего объекта/записи.
     */
    public function update()
    {
        $validation = new ValidationAuth($this);
        $validation = $validation->validation();

        if ($validation) {
            $query = DBAuth::pdo()->prepare('UPDATE auth SET login = ?, pass = ? WHERE id = ?');
            $query->execute([$validation->login, $validation->pass, $this->id]);
            echo 'Запись успешно добавлена.</br>';
            return true;
        } else {
            return false;
        }
    }
}