<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 12:29
 */

require_once __DIR__ . '/DB.php';
require_once __DIR__ . '/Validation.php';

class doctors
{
    public $id;
    public $lastName;
    public $name;
    public $phone;
    public $salary;
    public $receiptDate;

    public function __construct()
    {
        $this->id = null;
        $this->lastName = null;
        $this->name = null;
        $this->phone = null;
        $this->salary = null;
        $this->receiptDate = null;
    }

    /**
     * Возрощает обьект из таблицы по заданому индексу
     * @param $id
     * @return doctors|null
     */
    public static function find($id)
    {
        $query = DB::pdo()->prepare('SELECT * FROM doctors WHERE id = ?');
        $query->execute([$id]);
        if ($query->rowCount()) {
            $query = $query->fetch(PDO::FETCH_ASSOC);
            $row = new doctors();
            $row->id = $query['id'];
            $row->lastName = $query['last_name'];
            $row->name = $query['name'];
            $row->phone = $query['phone'];
            $row->salary = $query['salary'];
            $row->receiptDate = $query['receipt_date'];
            echo 'Запись прочитана.</br>';
            return $row;
        } else {
            echo 'Нет такого id' . '</br>';
        }
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {
        $doctor = new Validation($this);
        if ($doctor->validation()) {
            $query = DB::pdo()->prepare('INSERT INTO doctors (last_name, name, phone, salary, receipt_date) VALUE (?,?,?,?,?)');
            $query->execute([$doctor->lastName, $doctor->name, $doctor->phone, $doctor->salary, $doctor->receiptDate]);
            $query = DB::pdo()->prepare('SELECT * FROM doctors ORDER BY id DESC LIMIT 1');
            $query->execute();
            $this->id = $query->fetch(PDO::FETCH_ASSOC)['id'];
            echo 'Запись успешно добавлена.</br>';
            return true;
        } else {
            return false;
        }
    }

    /**
     * Создание обьекта с такими же данными как и у последней записи в таблице.
     */
    public function read()
    {
        $query = DB::pdo()->prepare('SELECT * FROM doctors ORDER BY id DESC LIMIT 1');
        $query->execute();
        if ($query->rowCount()) {
            $lastRow = $query->fetch(PDO::FETCH_ASSOC);
            $this->id = $lastRow['id'];
            $this->lastName = $lastRow['last_name'];
            $this->name = $lastRow['name'];
            $this->phone = $lastRow['phone'];
            $this->salary = $lastRow['salary'];
            $this->receiptDate = $lastRow['receipt_date'];
            echo 'Запись прочитана.</br>';
        } else {
            echo 'Нет такого id' . '</br>';
        }
    }

    /**
     * Обновление текущего объекта/записи.
     */
    public function update()
    {
        $doctor = new Validation($this);
        if ($doctor->validation()) {
            $query = DB::pdo()->prepare('UPDATE doctors SET last_name = ?, name = ?, phone = ?, salary = ?, receipt_date = ? WHERE id = ?');
            $query->execute([$doctor->lastName, $doctor->name, $doctor->phone, $doctor->salary, $doctor->receiptDate, $this->id]);
            echo 'Запись успешно добавлена.</br>';
            return true;
        } else {
            return false;
        }
    }

    /**
     * Удаление текущего обьекта/записи.
     */
    public function delete()
    {
        if ($this->id == null) {
            echo 'Записи с таким id не существует.</br>';
            return false;
        } else {
            $query = DB::pdo()->prepare('DELETE FROM doctors WHERE id = ?');
            $query->execute([$this->id]);
            echo 'Запись удалена.</br>';
        }
    }
}