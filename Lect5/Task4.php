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
$countWorkers = 0;
$departments = array();

$sumSalary = 0;
$sumAges = 0;


if ($fp) {
    $i = 0;
    while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
        $i++;
        $sumSalary += $data[3];
        $sumAges += $data[2];
        if (count($luckyPerson) > 0) {
            if ($luckyPerson[3] < $data[3]) {
                $luckyPerson = $data;
            }
        } else {
            $luckyPerson = $data;
        }
        if (count($unluckyPerson) > 0) {
            if ($unluckyPerson[3] > $data[3]) {
                $unluckyPerson = $data;
            }
        } else {
            $unluckyPerson = $data;
        }
        if (!(array_key_exists($data[1], $departments))) {
            $fp2 = fopen('users.csv', 'rb');
            $employees = 0;
            $sumSalaryByDepartments = 0;
            $sumAgesByDepartments = 0;
            $avgSalaryByDepartments = 0;
            $avgAgeByDepartments = 0;
            $luckyPersonFromDep = [];
            $unluckyPersonFromDep = [];
            while (($data2 = fgetcsv($fp2, 1000, ",")) !== FALSE) {
                if ($data[1] == $data2[1]) {
                    $sumSalaryByDepartments += $data2[3];
                    $sumAgesByDepartments += $data2[2];
                    $employees++;
                    if (count($luckyPersonFromDep) > 0) {
                        if ($luckyPersonFromDep[3] < $data2[3]) {
                            $luckyPersonFromDep = $data2;
                        }
                    } else {
                        $luckyPersonFromDep = $data2;
                    }
                    if (count($unluckyPersonFromDep) > 0) {
                        if ($unluckyPersonFromDep[3] > $data2[3]) {
                            $unluckyPersonFromDep = $data2;
                        }
                    } else {
                        $unluckyPersonFromDep = $data2;
                    }
                }
            }
            $departments[$data[1]] = [
                $employees,
                $avgSalaryByDepartments = $sumSalaryByDepartments / $employees,
                $sumAgesByDepartments = $sumAgesByDepartments / $employees,
                $luckyPersonFromDep,
                $unluckyPersonFromDep,
            ];
        }
    }
    fclose($fp);
    if ($i > 0) {
        $avgSalary = $sumSalary / $i;
        echo 'Средняя ЗП: ' . number_format($avgSalary, 2, ',', ' ') . '</br>';
        $avgAge = $sumAges / $i;
        echo 'Средний возраст:' . $avgAge . '</br>';
        echo 'Счастливчик: ' . $luckyPerson[0] . ' c ЗП: ' . number_format($luckyPerson[3], 2, ',', ' ') . '</br>';
        echo 'Неудачник: ' . $unluckyPerson[0] . ' c ЗП: ' . number_format($unluckyPerson[3], 2, ',', ' ') . '</br>' . '</br>';
        echo 'Статистика по отделам: ' . '</br>';
        foreach ($departments as $key => $value) {
            echo $key . ':</br>'
                . 'Колличесвто сотрудников в отделе: ' . $value[0] . '</br>'
                . 'Средняя зарплата по отделу: ' . number_format($value[1], 2, ',', ' ') . '</br>'
                . 'Средний возраст по отделу: ' . intval($value[2]) . '</br>'
                . 'Самый оплачиваемый сотрудник отдела:' . $value[3][0] . ' с ЗП: ' . number_format($value[3][3], 2, ',', ' ') . '</br>'
                . 'Самы перспективный сотрудник отдела:' . $value[4][0] . ' с ЗП: ' . number_format($value[4][3], 2, ',', ' ') . '</br>';
        }
        echo 'Список самых оплачиваемых сотрудников отделов:' . '</br>';
        foreach ($departments as $key => $value) {
            echo $key . ': ' . $value[3][0] . ' с ЗП: ' . number_format($value[3][3], 2, ',', ' ') . '</br>';
        }
        echo 'Список самых перспективных сотрудников отделов:' . '</br>';
        foreach ($departments as $key => $value) {
            echo $key . ': ' . $value[4][0] . ' с ЗП: ' . number_format($value[4][3], 2, ',', ' ') . '</br>';
        }
    } else {
        echo 'No Data';
    }

}