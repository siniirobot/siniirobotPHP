<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 31.10.2018
 * Time: 19:07
 */

session_start();
$i = $_SESSION['i'];

if (isset($_SESSION['i'])) {
    $i++;
}else{
    $i = 0;
}
echo $i;

