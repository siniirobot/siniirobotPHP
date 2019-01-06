<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/animalType.php';


$cat = new animalType();
$cat = $cat->find(1);
$cat->nameLAT = 24e214;
$cat->update();
$olen = new animalType();
$olen = $olen->find(18);
$olen->delete();
