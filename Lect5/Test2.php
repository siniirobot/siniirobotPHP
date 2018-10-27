<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 27.10.2018
 * Time: 11:44
 */

$fNnames = [
    ['Василий','m'],
    ['Петр','m'],
    ['Ольга','f'],
    ['Лаврентий','m'],
    ['Николай','m'],
    ['Елена','f'],
    ['Алексей','m'],
    ['Александр','m'],
    ['Александра','f'],
    ['Марина','f'],
];
$lNnames = [
    'Петров',
    'Васечкин',
    'Пукин',
    'Совин',
    'Николев',
    'Ивонов',
    'Васильев',
    'Сидоров',
    'Кошкин',
    'Собакин',
];

$departments = [
    'Маркетинг',
    'Бухгалтерия',
    'Отдел разработки',
    'Дизайн',
    'Разработка',
];

function make_seed(){
    list($usec ,$sec) = explode(' ', microtime());
    return $sec + $usec * 1000000;
}

if ($fp = fopen('users.csv', 'w')) {
    for ($i = 0; $i < 1000; $i++){
        srand(make_seed());
        $f = $fNnames[rand(0, count($fNnames) - 1)];
        $name = $f[0].' '.$lNnames[rand(0,count($lNnames) - 1)].($f[1] == 'f');
        $dep = $departments[rand(0,count($departments) - 1)];
        $age = rand(18,65);
        $salary = rand(20,200);
        fputcsv($fp, [$name, $dep, $age, $salary* 1000], ',');
    }
    fclose($fp);
    echo 'DONE';
}