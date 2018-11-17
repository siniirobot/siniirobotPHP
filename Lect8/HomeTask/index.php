<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 8:32
 */

require_once __DIR__ . '/Classes/Worker.php';

$worker = new Worker('Pit',25);

$worker->setWorkDay(15);
var_dump($worker->getWorkDay());
echo $worker->getCalculateSalary();