<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 29.10.2018
 * Time: 13:00
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$fp = fopen('users.csv', 'rb');
$avgSalary = 0;
$avgAge = 0;
$luckyPerson = [];
$unluckyPerson = [];
$departments = [
    'ля'
];
$sumSalary = 0;
$sumAges = 0;

if ($fp) {
    $i = 0;
    $j = 0;
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $i++;
        $sumSalary += $data[3];
        $sumAges += $data[2];
        if (count($luckyPerson) > 0) {
            if ($luckyPerson[3] < $data[3]) {
                $luckyPerson = $data;
            }
        }else {
            $luckyPerson = $data;
        }
        if (count($unluckyPerson) > 0) {
            if ($unluckyPerson[3] > $data[3]) {
                $unluckyPerson = $data;
            }
        }else {
            $unluckyPerson = $data;
        }
        if ($departments[$j] != $data[1]) {
            while (($data2 = fgetcsv($fp, 1000, ",")) !== FALSE) {
                if ($departments[$j])
                $departments[$j] = $data2[1];
            }
            $j++;
        }
        /*
        $num = count($data);
        echo "<p> $num полей в строке $row: <br /></p>\n";
        $row++;
        for ($c=0; $c < $num; $c++) {
            echo $data[$c] . "<br />\n";
        }*/
    }
    fclose($fp);
    foreach ($departments as $key => $value) {
        echo $key.'----'.$value.'</br>';
    }
    if ($i > 0) {
        $avgSalary = $sumSalary / $i;
        echo 'Средняя ЗП: ' . number_format($avgSalary, 2, ',', ' ') . '</br>';
        $avgAge = $sumAges / $i;
        echo 'Средний возраст:' . $avgAge . '</br>';
        echo 'Счастливчик: ' . $luckyPerson[0] . ' c ЗП: ' . number_format($luckyPerson[3], 2, ',', ' ') . '</br>';
        echo 'Неудачник: ' . $unluckyPerson[0] . ' c ЗП: ' . number_format($unluckyPerson[3], 2, ',', ' ') . '</br>';
    } else {
        echo 'No Data';
    }

}