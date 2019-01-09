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
            $row->receipt_date = $query['receipt_date'];
            echo 'Запись прочитана.</br>';
            return $row;
        } else {
            echo 'Нет такого id' . '</br>';
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

    function checkLength($value, $min, $max)
    {
        return mb_strlen($value) <= $max && mb_strlen($value) > $min;
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {
        if ($this->lastName != null && $this->name != null && $this->salary != null && $this->receipt_date != null) {
            $lastName = $this->clean($this->lastName);
            $name = $this->clean($this->name);
            $phone = $this->clean($this->phone);
            $salary = (float)$this->clean($this->salary);
            $receiptDate = $this->clean($this->receipt_date);
            if ($this->checkLength($lastName, 1, 255) && $this->checkLength($name, 1, 255) && $this->checkLength($phone, 12, 18)) {
                if (preg_match('/^((\+?7|8)[\s \-]?){1}((\(\d{3}\))|(\d{3})){1}([\s \-]?){1}(\d{3}[\s \-]?\d{2}[\s \-]?\d{2}){1}$/', $phone)) {
                    if (preg_match('/\d{4}-\d{2}-\d{2}/', $receiptDate)) {
                        $query = DB::pdo()->prepare('INSERT INTO doctors (last_name, name, phone, salary, receipt_date) VALUE (?,?,?,?,?)');
                        $query->execute([$lastName, $name, $phone, $salary, $receiptDate]);
                        $query = DB::pdo()->prepare('SELECT * FROM doctors ORDER BY id DESC LIMIT 1');
                        $query->execute();
                        $this->id = $query->fetch(PDO::FETCH_ASSOC)['id'];
                        echo 'Запись успешно добавлена.</br>';
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
            $this->receipt_date = $lastRow['receipt_date'];
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
        if ($this->lastName != null && $this->name != null && $this->salary != null && $this->receipt_date != null) {
            $lastName = $this->clean($this->lastName);
            $name = $this->clean($this->name);
            $phone = $this->clean($this->phone);
            $salary = (float)$this->clean($this->salary);
            $receiptDate = $this->clean($this->receipt_date);
            if ($this->checkLength($lastName, 1, 255) && $this->checkLength($name, 1, 255) && $this->checkLength($phone, 12, 18)) {
                if (preg_match('/^((\+?7|8)[\s \-]?){1}((\(\d{3}\))|(\d{3})){1}([\s \-]?){1}(\d{3}[\s \-]?\d{2}[\s \-]?\d{2}){1}$/', $phone)) {
                    if (preg_match('/\d{4}-\d{2}-\d{2}/', $receiptDate)) {
                        $query = DB::pdo()->prepare('UPDATE doctors SET last_name = ?, name = ?, phone = ?, salary = ?, receipt_date = ? WHERE id = ?');
                        $query->execute([$lastName, $name, $phone, $salary, $receiptDate, $this->id]);
                        echo 'Запись успешно обновлена.</br>';
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