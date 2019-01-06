<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/animalType.php';


$olen = new animalType();
$olen->nameRUS = 'Козел';
$olen->nameLAT = 'Kozel';
$olen->create();

$olen->nameRUS = 'Олень';
$olen->nameLAT = 'Olen';
$olen->update();
$olen->delete();

$read = new animalType();
$read->update();
$read->read();
echo '|'.$read->id.'|'.$read->nameRUS.'|'.$read->nameLAT.'|</br>';
$read->nameRUS = 'Бык';
$read->nameLAT = 'Bik';
$read->update();
$read->find(5);
$cat = $read->find(14);
echo $cat->id.'|'.$cat->nameRUS.'|'.$cat->nameLAT;
$cat->delete();