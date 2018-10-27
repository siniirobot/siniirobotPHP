<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 26.10.2018
 * Time: 10:31
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$number = isset($_GET['number']) ? intval($_GET['number']) : 0;

if (isset($_GET['random'])) {
    $random = intval($_GET['random']);
    if ($number > $random) {
        echo "Надо меньше";
    } elseif ($number < $random) {
        echo "Нужо больше";
    }else{
        echo "Это оно поздравляю";
    }
}else{
    $random = rand(0, 100);
}
?>

<html>
<head>
    <title>Угадай число</title>
</head>
<body>
<p>Попробуйте ввести число от 0 до 100 и угадать.</p>
<form action="Task1.php" method="get">
    <input type="text" name="number" value="<?=$number?>">
    </br>
    <input type="submit" value="Это число?">
    <input type="hidden" name="random" value="<?=$random?>" >
</form>
</body>
</html>
