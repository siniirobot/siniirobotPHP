<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.10.2018
 * Time: 22:06
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$simpleNumbersCount = isset($_POST['simpleNumbersCount']) ? $_POST['simpleNumbersCount'] : '';

function simpleNumbers($simpleNumbersCount) {

    if (isset($_POST['simpleNumbersCount']) && $_POST['simpleNumbersCount'] > 0) {
    for ($i = 2; $i <= $simpleNumbersCount; ++$i) {
        $simple = false;
        for ($j = 2; $i % $j != 0; ++$j) {
            if ($j * $j > $i) {
                $simple = true;
                break;
            }
        }
        if ($simple || $i == 2) {
            echo $i . '</br>';
        }
    }
}
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Не простое число</title>
</head>
<body>
<form action="Task3.php" method="post">
    <input type="text" name="simpleNumbersCount" value="">
    <input type="submit" name="Output" value="Вывод">
</form>
<?php simpleNumbers($simpleNumbersCount)?>
</body>
</html>