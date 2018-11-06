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
$start = 0;

if (isset($_POST['firstPage']) && $_POST['firstPage']) {
    $start = 0;
    echo 'Это страница 0';
}else

if (isset($_POST['back']) && $_POST['back'] && $start > 0) {
    $start = $start - 1;
    echo 'Это страница назад';
}else

if ($_POST['forward'] && $start < 49) {
    $start = $start + 1;
    echo 'Это страница вперед';
}else

if (isset($_POST['lastPage']) && $_POST['lastPage']) {
    $start = 49;
    echo 'Это страница 49';
}else
if (isset($_POST['page'])){
    $start = $_POST['page'];
    echo 'это страница'.$start;
}
echo '</br>'.'текущая страница'.$start;

?>

<!DOCTYPE html>
<html>
<head>
    <title>20 на странице</title>
</head>
<body>
<div>
    <?php
    if ($fp) {
        while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
            $i++;
            if ($i / 20 > $start) {
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
<div>
    <form action="Task5.php" method="post">
        <input style="width: 150px" type="submit" name="firstPage" value="На первую страницу">
        <input type="submit" name="back" value="&#8592;">

        <input type="text" name="page" value="<?=$start?>" style="width: 30px">
        <input type="submit" name="forward" value="&#8594;">

        <input style="width: 150px" type="submit" name="lastPage" value="На последнюю страницу">
    </form>
</div>

</body>
</html>
<?php
if ($_POST['page']) {
    echo 'Этак кнопка page правда'.'</br>';
}else{
    echo 'Этак кнопка page не правда'.'</br>';
}
if ($_POST['firstPage']) {
    echo 'Этак кнопка firstPage правда'.'</br>';
}else{
    echo 'Этак кнопка firstPage не правда'.'</br>';
}
if ($_POST['back']) {
    echo 'Этак кнопка back правда'.'</br>';
}else{
    echo 'Этак кнопка back не правда'.'</br>';
}
if ($_POST['forward']) {
    echo 'Этак кнопка forward правда'.'</br>';
}else{
    echo 'Этак кнопка forward не правда'.'</br>';
}
if ($_POST['lastPage']) {
    echo 'Этак кнопка lastPage правда'.'</br>';
}else{
    echo 'Этак кнопка lastPage не правда'.'</br>';
}
?>