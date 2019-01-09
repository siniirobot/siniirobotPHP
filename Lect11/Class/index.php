<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/animalType.php';

$animalType = new animalType();

$animalType->find(6);
echo $animalType->nameRUS.'</br>';
echo $animalType->nameLAT.'</br>';
$animalType->nameRUS = 'Синица';
$animalType->nameLAT ='Sinica';
//$animalType->save();
echo $animalType->read();