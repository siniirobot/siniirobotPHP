<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 12:29
 */

class animalType
{

    public $nameRUS;
    public $nameLAT;

    public  function find($id) {
        require_once __DIR__.'/DB.php';
        $result  = DB::pdo()->prepare('SELECT * FROM animalType WHERE id = ?');
        $result->execute([$id]);
        $result = $result->fetch(PDO::FETCH_ASSOC);
        if ($result){
            $this->nameRUS = $result['nameRUS'];
            $this->nameLAT = $result['nameLAT'];
            return 'Ваши данные найдены';
        }else{
            return 'Нет такого id';
        }
    }

    public function read(){
        require_once __DIR__.'/DB.php';
        $result = DB::pdo()->prepare('SELECT * FROM animalType');
        $result->execute();
        $result = $result->fetchAll();
        var_dump($result);
        $this->nameRUS = $result['nameRUS'];
        $this->nameLAT = $result['nameLAT'];
        var_dump($this->nameRUS);
        var_dump($this->nameLAT);
        while ($row = $result->fetch(PDO::FETCH_ASSOC)){
            echo $row['id'].'|'.$row['nameRUS'].'|'.$row['nameLAT'].'</br>';
        }
    }

    public function save() {
        require_once __DIR__.'/DB.php';
        $result  = DB::pdo()->prepare('INSERT INTO animalType (nameRUS,nameLAT) VALUE (?,?)');
        $result->execute([$this->nameRUS,$this->nameLAT]);
    }
}