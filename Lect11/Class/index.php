<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/animalType.php';

$animalType = new animalType();

echo $animalType->getFind(16);

