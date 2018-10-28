<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.10.2018
 * Time: 20:51
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$simpleNumbersCount = isset($_POST['simpleNumbersCount']) ? $_POST['simpleNumbersCount'] : '';

?>

<!DOCTYPE html>
<html>
<head>
    <title>Не простое число</title>
</head>
<body>
    <form action="Task4.php" method="post">
        <input type="text" name="simpleNumbersCount" value="">
        <input type="submit" name="Output" value="Вывод">
    </form>
    <?php if (isset($_POST['simpleNumbersCount']) && $_POST['simpleNumbersCount'] > 0) {
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
    ?>
</body>
</html>

