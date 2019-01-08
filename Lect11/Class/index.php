<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:20
 */

include_once __DIR__ . '/doctors.php';


$cat = new doctors();
$cat = $cat->find(1);
$cat->nameLAT = 'Арнольд Шварцнегер';
$cat->update();
$olen = new doctors();
$olen = $olen->find(2);
var_dump($olen);
