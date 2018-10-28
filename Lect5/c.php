<?php
header('Content-Type: text/html;charset=utf-8');

$handle = fopen('users.csv', 'rb');

$avgSalary = 0;
$avgAge = 0;
$luckyPerson = [];
$unluckyPerson = [];

$sumSalary = 0;
$sumAge = 0;

if ($handle) {
    $i = 0;
    while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
        $i++;
        $sumAge += $data[2];
        $sumSalary += $data[3];
        if (count($luckyPerson) > 0)
        {
            if ($luckyPerson[3] < $data[3])
                $luckyPerson = $data;
        }
        else
        {
            $luckyPerson = $data;
        }
        if (count($unluckyPerson) > 0)
        {
            if ($unluckyPerson[3] > $data[3])
                $unluckyPerson = $data;
        }
        else
        {
            $unluckyPerson = $data;
        }
        //        $num = count($data);
//        echo "<p> $num fields in line $row: <br /></p>\n";
//        $row++;
//        for ($c=0; $c < $num; $c++) {
//            echo $data[$c] . "<br />\n";
//        }
    }
    fclose($handle);
    if ($i > 0) {
        echo 'Средняя ЗП: '.number_format($sumSalary/$i, 2, ',', ' ').'<br>';
        echo 'Средний возраст: '.($sumAge/$i).'<br>';
        echo 'Счастливчик: '.$luckyPerson[0].' с ЗП: '.number_format($luckyPerson[3], 0, ',', ' ').'<br>';
        echo 'Неудачник: '.$unluckyPerson[0].' с ЗП: '.number_format($unluckyPerson[3], 0, ',', ' ');
    } else {
        echo 'No Data';
    }
}