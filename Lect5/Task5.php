<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 30.10.2018
 * Time: 15:49
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$fp = fopen('users.csv', 'rb');
$i = 0;
$j = 0;

$start =  isset($_GET['page']) ? intval($_GET['page']) : 1;

if (isset($_GET['forward']) && $start < 50){
    $start++;
}elseif(isset($_GET['back']) && $start > 1){
    $start--;
}elseif(isset($_GET['lastPage']) || $start > 50){
    $start = 50;
}elseif(isset($_GET['firstPage']) || $start < 1){
    $start= 1;
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>20 на странице</title>
    <style>
        div{
            margin: auto;
            padding-top: 30px;
        }
    </style>
</head>
<body>
<div style="width: 380px;">
    <?php
    if ($fp) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $i++;
            if ($i / 20 > $start -1) {
                echo $i . '-' . $data[0] . ' ' . $data[1] . ' ' . $data[2] . ' ' . $data[3] . '</br>';
                $j++;
                if ($j == 20) {
                    $j = 0;
                    break;
                }
            }
        }
    } else {
        echo 'Проблемы с открытием файла';
    } ?>
</div>
<div style="width: 505px;">
    <form action="Task5.php" method="get" style="display: inline">
        <input style="width: auto;display: inline" type="submit" name="firstPage" value="Перейти к первой странице">
        <input type="hidden" name="page" value="<?=$start?>">
        <input style="display: inline" type="submit" name="back" value="&#8592;">
    </form>

    <form action="Task5.php" method="get" style="display: inline">
        <input  type="text" name="page" value="<?=$start?>" style="width: 30px">
    </form>

    <form action="Task5.php" method="get" style="display: inline">
        <input type="submit" name="forward" value="&#8594;">
        <input type="hidden" name="page" value="<?=$start?>">
        <input style="width: auto" type="submit" name="lastPage" value="Перейти к последней странице">
    </form>
</div>
</body>
</html>
