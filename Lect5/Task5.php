<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 30.10.2018
 * Time: 15:49
 */

header('Content-Type: text/html; charset=utf-8');
//error_reporting(E_ALL);

$fp = fopen('users.csv', 'rb');
$i = 0;
$j = 0;
$start = isset($_GET['page']) ? intval($_GET['page']) : 0;

echo var_dump($_GET['firstPage']).'</br>';
echo var_dump($_GET['back']).'</br>';
echo var_dump($_GET['page']).'</br>';
echo var_dump($_GET['forward']).'</br>';
echo var_dump($_GET['lastPage']).'</br>';

if (isset($_GET['forward'])){
    $start++;
}elseif(isset($_GET['back'])){
    $start--;
}elseif($_GET['lastPage']){
    $start = 49;
}elseif ($_GET['lastPage']){
    $start=0;
}else{
    $start = isset($_GET['page']) ? intval($_GET['page']) : 0;
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
    <form action="Task5.php" method="get">
        <input style="width: 150px" type="submit" name="firstPage" value="На первую страницу">
        <input type="submit" name="back" value="&#8592;">

        <input type="text" name="page" value="<?=$start?>" style="width: 30px">
        <input type="submit" name="forward" value="&#8594;">

        <input style="width: 150px" type="submit" name="lastPage" value="На последнюю страницу">
    </form>
</div>

</body>
</html>
