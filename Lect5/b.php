<?php

$fNames = [
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
$lNames = [
    'Петров',
    'Васечкин',
    'Сидоров',
    'Иванов',
    'Зайцев',
    'Кошкин',
    'Собакин',
];

$departments = [
    'Маркетинг',
    'Бухгалетерия',
    'Отдел развития',
    'Дизайн',
    'Разработка',
];

function make_seed()
{
    list($usec, $sec) = explode(' ', microtime());
    return $sec + $usec * 1000000;
}

if ($fp = fopen('users.csv', 'w')) {
    for ($i = 0; $i < 1000; $i++) {
        srand(make_seed());
        $f = $fNames[rand(0, count($fNames) - 1)];
        $name = $f[0].' '.$lNames[rand(0, count($lNames) - 1)].($f[1] == 'f' ? 'а' : '');
        $dep = $departments[rand(0, count($departments) - 1)];
        $age = rand(18, 65);
        $salary = rand(20, 200);
        fputcsv($fp, [$name, $dep, $age, $salary*1000], ',');
    }
    fclose($fp);
    echo 'DONE';
} else {
    echo 'Can\'t create file users.csv';
}
