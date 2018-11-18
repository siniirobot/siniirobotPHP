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
echo 'Зп рабочего - '. $worker->getCalculateSalary().'</br>';

$teacher = new Teacher('Lena',1400, 31);
$teacher->setWorkDay(26);
echo 'Зп учителя - '.$teacher->getCalculateSalary().'</br>';

$builder = new Builder('Serega',500);
$builder->setWorkDay(32);
echo 'Зп строителя - '.$builder->getCalculateSalary();


