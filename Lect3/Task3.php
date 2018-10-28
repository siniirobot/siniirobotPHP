<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.10.2018
 * Time: 14:25
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$arrayElements = rand(1,1000);
$arr = [];
for ($h = 1; $h < $arrayElements; $h++) {
    $arr[] = $h;
}
$columnCount = isset($_POST['columnCount']) ? intval($_POST['columnCount']) : '';

if (isset($_POST['columnCount']) && $_POST['columnCount'] > 0) {
    $rowsCount = ceil(count($arr) / $columnCount);
}else{
    echo 'Вы ввели что не то надо вести число больше нуля';
}
?>

<!DOCTYPE html>
<html>
    <head>
        <title>Массив в колоны</title>
    </head>
    <body>
        <form action="Task3.php" method="post">
            <input style="width: 200px" type="text" name="columnCount" placeholder="Введите количество колонок" value="<?= $columnCount ?>">
            <input type="submit" value="Создать">
        </form>
        <?php if (isset($_POST['columnCount']) && $_POST['columnCount'] > 0) { ?>
            <table width="100%" bgcolor="#8a2be2" border="5px" style="color: white">
                <?php for ($i = 0; $i < $rowsCount; $i++) {
                    echo '<tr>';
                         for ($j = 0; $j < $columnCount; $j++) {

                                 $k = $i + ($rowsCount * $j);

                             if (count($arr) <= $k) {
                                 echo '<td><p>Здесь могла бы быть ваша реклама</p></td>';
                             } else {
                                 echo '<td><p>' . $arr[$k] . '</p></td>';
                             }
                         }
                    echo '</tr>';
                } ?>
            </table>
        <?php } ?>
    </body>
</html>
