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
$page = isset($_POST['page']) ? intval($_POST['page']) : 0;


if (isset($_POST['firstPage']) && $_POST['firstPage']) {
    $page = 0;
} elseif (isset($_POST['back']) && $_POST['back'] && $page > 0) {
    $page--;
} elseif (isset($_POST['forward']) && $_POST['forward'] && $page < 49) {
    $page++;
} elseif (isset($_POST['lastPage']) && $_POST['lastPage']) {
    $page = 49;
} else {
    $page = isset($_POST['page']) ? intval($_POST['page']) : 0;
}


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
            if ($i / 20 > $page) {
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
        <input type="hidden" name="back" value="<?= $page - 1 ?>">
        <input type="text" name="page" value="<?= $page ?>" style="width: 30px">
        <input type="submit" name="forward" value="&#8594;">
        <input type="hidden" name="forward" value="<?= $page + 1 ?>">
        <input style="width: 150px" type="submit" name="lastPage" value="На последнюю страницу">
    </form>
</div>

</body>
</html>
