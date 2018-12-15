<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 12:29
 */

class animalType
{
    public $query;

    public function __construct()
    {
        require_once __DIR__ . '/DB.php';
        $this->query = DB::pdo()->query('SELECT * FROM animalType');
    }

    public function getFind($id) {

        while ($row = $this->query->fetch()){
            if ($id == $row['id']){
                return $row['nameRUS'].' '.$row['nameLAT'];
            }
        }
        return'Нету такого id';
    }
}