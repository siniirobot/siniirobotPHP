<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 12:29
 */

require_once __DIR__ . '/DB.php';

class doctors
{
    public $id;
    public $lastName;
    public $name;
    public $phone;
    public $salary;
    public $receipt_date;

    public function __construct()
    {
        $this->id = null;
        $this->lastName = null;
        $this->name = null;
        $this->phone = null;
        $this->salary = null;
        $this->receipt_date = null;
    }

    /**
     * Возрощает обьект из таблицы по заданому индексу
     * @param $id
     * @return doctors|null
     */
    public static function find($id)
    {
        $query = DB::pdo()->prepare('SELECT * FROM animalType WHERE id = ?');
        $query->execute([$id]);
        $query = $query->fetch(PDO::FETCH_ASSOC);
        if ($query) {
            $row = new doctors();
            $row->id = $query['id'];
            $row->nameRUS = $query['nameRUS'];
            $row->nameLAT = $query['nameLAT'];
            return $row;
        } else {
            echo 'Нет такого id' . '</br>';
            return false;
        }
    }

    /**
     * Удаляет пробелы из начала и конца строки.
     * Удаляет экранированные символы.
     * Удаляет HTML и PHP теги.
     * Преобразует спец символы символы.
     * @param $value
     * @return string
     */
    function clean($value)
    {
        $value = trim($value);
        $value = stripslashes($value);
        $value = strip_tags($value);
        $value = htmlspecialchars($value);

        return $value;
    }

    function checkLength($value, $max)
    {
        return mb_strlen($value) <= $max;
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {
        if ($this->lastName != null || $this->name != null || $this->salary != null || $this->receipt_date != null) {
            $lastName = $this->clean($this->lastName);
            $name = $this->clean($this->name);
            $phone = $this->clean($this->phone);
            $salary = $this->clean($this->salary);
            $receiptDate = $this->clean($this->receipt_date);
            if ($this->checkLength($lastName, 255) || $this->checkLength($name, 255) || $this->checkLength($phone, 12)) {

                $query = DB::pdo()->prepare('INSERT INTO doctors (last_name, name, phone, salary, receipt_date) VALUE (?,?,?,?,?)');
                $query->execute([$this->lastName, $this->name, $this->phone, $this->salary, $this->receipt_date]);
                $query = DB::pdo()->prepare('SELECT * FROM doctors ORDER BY id DESC LIMIT 1');
                $query->execute();
                $this->id = $query->fetch(PDO::FETCH_ASSOC)['id'];
            }
        }
    }

    /**
     * Создание обьекта с такими же данными как и у последней записи в таблице.
     */
    public function read()
    {
        $query = DB::pdo()->prepare('SELECT * FROM animalType ORDER BY id DESC LIMIT 1');
        $query->execute();
        $lastRow = $query->fetch(PDO::FETCH_ASSOC);
        if ($lastRow) {
            $this->id = $lastRow['id'];
            $this->nameRUS = $lastRow['nameRUS'];
            $this->nameLAT = $lastRow['nameLAT'];
        } else {
            echo 'Нет такого id' . '</br>';
        }
    }

    /**
     * Обновление текущего объекта/записи.
     */
    public function update()
    {
        try {
            $query = DB::pdo()->prepare('UPDATE animalType SET nameRUS = ? , nameLAT = ? WHERE id = ?');
            $query->execute([$this->nameRUS, $this->nameLAT, $this->id]);
            if ($query->rowCount() == 0) {
                echo 'Запись не была изменена.</br>';
            } else {
                echo 'Запись была изменена.</br>';
            }
        } catch (Exception $e) {
            echo $e;
        }
    }

    /**
     * Удаление текущего обьекта/записи.
     */
    public function delete()
    {
        try {
            $query = DB::pdo()->prepare('DELETE FROM animalType WHERE id = ?');
            $query->execute([$this->id]);
            if ($query->rowCount() == 0) {
                echo 'Запись не была удалена.</br>';
            } else {
                echo 'Запись была удалена.';
            }
        } catch (Exception $e) {
            echo $e;
        }

    }
}