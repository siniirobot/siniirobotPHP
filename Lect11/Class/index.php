<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/doctors.php';

$pokemon = new doctors();
$pokemon->lastName = 'Pikachu';
$pokemon->name = 'Pika';
$pokemon->phone = '+7-(155)-754-24-65';
$pokemon->salary = 35600.50;
$pokemon->receiptDate = '2019-01-17';
$pokemon->create();

$lastRow = new doctors();
$lastRow->read();
echo $lastRow->lastName .'</br>'. $lastRow->name.'</br>'.$lastRow->phone.'</br>'.$lastRow->salary.'</br>'.$lastRow->receiptDate.'</br>';


$findRow = new doctors();
$findRow = $findRow->find(1);
echo $findRow->lastName .'</br>'. $findRow->name.'</br>'.$findRow->phone.'</br>'.$findRow->salary.'</br>'.$findRow->receiptDate.'</br>';

$findRow->phone = '+7-(912)-142-45-78';
$findRow->update();

$findRow->receiptDate = '2500-12-18';
$findRow->update();

$deleteRow = new doctors();
$deleteRow = $deleteRow->find(47);


$some = new doctors();
