<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:32
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
require_once __DIR__ . '/Classes/Workers.php';
require_once __DIR__ . '/Classes/Teacher.php';

$worker = new Workers('Pit',1095.23);

$worker->setWorkDay(21);
echo $worker->getCalculateSalary().'</br>';

$teacher = new Teacher('Lena',1400, 30);
$teacher->setWorkDay(0);
echo $teacher->getCalculateSalary().'</br>';


