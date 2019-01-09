<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/doctors.php';
$tel = '8-913-907-74-08';
//var_dump(preg_match('/^((\+?7|8)[\s \-]?){1}((\(\d{3}\))|(\d{3})){1}([\s \-]?){1}(\d{3}[\s \-]?\d{2}[\s \-]?\d{2}){1}$/',$tel));
$pokemon = new doctors();
$pokemon->lastName = 'Pikachu';
$pokemon->name = 'Pika';
$pokemon->phone = '+7-(951)-368-86-64';
$pokemon->salary = 35600.50;
$pokemon->receipt_date = '2019-01-17';
//$pokemon->create();

$lastRow = new doctors();
$lastRow->read();
echo $lastRow->lastName .'</br>'. $lastRow->name.'</br>'.$lastRow->phone.'</br>'.$lastRow->salary.'</br>'.$lastRow->receipt_date.'</br>';

echo 'Поиск</br>';
$findRow = new doctors();
$findRow = $findRow->find(1);
echo $findRow->lastName .'</br>'. $findRow->name.'</br>'.$findRow->phone.'</br>'.$findRow->salary.'</br>'.$findRow->receipt_date.'</br>';

$findRow->phone = '+7-(912)-142-45-78';
$findRow->update();

$findRow->receipt_date = '2500-12-18';
$findRow->update();

$deleteRow = new doctors();
$deleteRow = $deleteRow->find(30);
$deleteRow->delete();