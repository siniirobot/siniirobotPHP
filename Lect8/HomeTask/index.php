<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:32
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

require_once __DIR__ . '/autoloadWorkers.php';

use Classes\Workers;
use Classes\Teacher;
use Classes\Builder;

$worker = new Workers('Pit',1095.23);

$worker->setWorkDay(21);
echo 'Зп рабочего Pita - '. $worker->getCalculateSalary().'</br>';

$workerJoe = new Workers('Joe',2000);
$workerJoe->setWorkDay(-1);
echo 'Зп рабочего Joe - '. $workerJoe->getCalculateSalary().'</br>';

$teacher = new Teacher('Lena',1400, 31);
$teacher->setWorkDay(26);
echo 'Зп учителя Lena - '.$teacher->getCalculateSalary().'</br>';

$teacherMasha = new Teacher('Masha',1100, 3);
$teacherMasha->setWorkDay(0);
echo 'Зп учителя Masha - '.$teacherMasha->getCalculateSalary().'</br>';

$teacherAnna = new Teacher('Anna',25000, 10);
$teacherAnna->setWorkDay(15);
echo 'Зп учителя Anna - '.$teacherAnna->getCalculateSalary().'</br>';

$builder = new Builder('Serega',500);
$builder->setWorkDay(32);
echo 'Зп строителя Serega - '.$builder->getCalculateSalary().'</br>';

$builderMisha = new Builder('Misha',500);
$builderMisha->setWorkDay(0);
echo 'Зп строителя Misha - '.$builderMisha->getCalculateSalary();


