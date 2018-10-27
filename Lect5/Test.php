<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 27.10.2018
 * Time: 11:26
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$a = json_decode(file_get_contents('test.json'));
echo $a ->features[0] -> properties-> CompanyMetaData -> name;

