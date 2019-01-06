<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 12:29
 */

require_once __DIR__ . '/DB.php';

class animalType
{
    public $id;
    public $nameRUS;
    public $nameLAT;

    public function __construct()
    {
        $this->id = null;
        $this->nameRUS = null;
        $this->nameLAT = null;
    }

    /**
     * Возрощает обьект из таблицы по заданому индексу
     * @param $id
     * @return animalType|null
     */
    public static function find($id)
    {
        $query = DB::pdo()->prepare('SELECT * FROM animalType WHERE id = ?');
        $query->execute([$id]);
        $query = $query->fetch(PDO::FETCH_ASSOC);
        if ($query) {
            $row = new animalType();
            $row->id = $query['id'];
            $row->nameRUS = $query['nameRUS'];
            $row->nameLAT = $query['nameLAT'];
            return $row;
        } else {
            echo 'Нет такого id'.'</br>';
            return null;
        }
    }

    /**
     * Создание нового обьекта/записи и добавление ее в конец списка.
     */
    public function create()
    {
        $query = DB::pdo()->prepare('INSERT INTO animalType(nameRUS, nameLAT) VALUE (?,?)');
        $query->execute([$this->nameRUS, $this->nameLAT]);
        $query = DB::pdo()->prepare('SELECT * FROM animalType ORDER BY id DESC LIMIT 1');
        $query->execute();
        $this->id = $query->fetch(PDO::FETCH_ASSOC)['id'];
    }

    /**
     * Создание обьекта с такими же данными как и у последней записи в таблице.
     */
    public function read()
    {
        $query = DB::pdo()->prepare('SELECT * FROM animalType ORDER BY id DESC LIMIT 1');
        $query->execute();
        $lastRow = $query->fetch(PDO::FETCH_ASSOC);
        if ($lastRow){
            $this->id = $lastRow['id'];
            $this->nameRUS = $lastRow['nameRUS'];
            $this->nameLAT = $lastRow['nameLAT'];
        }else{
            echo 'Нет такого id'.'</br>';
        }
    }

    /**
     * Обновление текущего объекта/записи.
     */
    public function update()
    {
        try{
            $query = DB::pdo()->prepare('UPDATE animalType SET nameRUS = ? , nameLAT = ? WHERE id = ?');
            $query->execute([$this->nameRUS, $this->nameLAT, $this->id]);
            if ($query->rowCount() == 0 ){
                echo 'Запись не была изменена.</br>';
            }else{
                echo 'Запись была изменена.';
            }
        }catch (Exception $e){
            echo $e;
        }
    }

    /**
     * Удаление текущего обьекта/записи.
     */
    public function delete()
    {
        try{
            $query = DB::pdo()->prepare('DELETE FROM animalType WHERE id = ?');
            $query->execute([$this->id]);
            if ($query->rowCount() == 0 ){
                echo 'Запись не была удалена.</br>';
            }else{
                echo 'Запись была удалена.';
            }
        }catch (Exception $e) {
            echo $e;
        }

    }
}