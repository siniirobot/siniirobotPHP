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
//echo $a ->features[0] -> properties-> CompanyMetaData -> name;

foreach($a->features as $i => $v){
    echo $v-> properties-> CompanyMetaData -> name;
    echo ',';
    echo $v->properties-> CompanyMetaData -> address;
    echo ',';
    echo $v->properties-> CompanyMetaData -> url;
    if (is_array($v->properties-> CompanyMetaData -> Phones)) {
        foreach ($v->properties-> CompanyMetaData -> Phones as $a => $p){
            echo  $p->formatted.';'.'</br>';
        }
    }
    echo $v->geometry->coordinates[0];
    echo ','.'</br>';
    echo $v->geometry->coordinates[1];
    echo '.'.'</br>'.'</br>';
}
//print_r(json_decode(file_get_contents('test.json')));



