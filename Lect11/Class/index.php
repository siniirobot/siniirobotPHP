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
$pokemon->receipt_date = '2019-01-17';
$pokemon->create();

$lastRow = new doctors();
$lastRow->read();
echo $lastRow->lastName .'</br>'. $lastRow->name.'</br>'.$lastRow->phone.'</br>'.$lastRow->salary.'</br>'.$lastRow->receipt_date.'</br>';


$findRow = new doctors();
$findRow = $findRow->find(1);
echo $findRow->lastName .'</br>'. $findRow->name.'</br>'.$findRow->phone.'</br>'.$findRow->salary.'</br>'.$findRow->receipt_date.'</br>';

$findRow->phone = '+7-(912)-142-45-78';
$findRow->update();

$findRow->receipt_date = '2500-12-18';
$findRow->update();

$deleteRow = new doctors();
$deleteRow = $deleteRow->find(47);
$deleteRow->delete();

$some = new doctors();
$some->delete();