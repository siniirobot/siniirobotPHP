<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 27.10.2018
 * Time: 21:45
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
session_start();
if (isset($_SESSION['session'])) {
    require_once __DIR__ . 'Classes/user.php';
    $login = $_SESSION['session']['login'];
    $pass = $_SESSION['session']['pass'];
    $user = new user($login, $pass);
    $firstNumber = isset($_GET['firstNumber']) ? intval($_GET['firstNumber']) : '';
    $sign = isset($_GET['sign']) ? $_GET['sign'] : 'введите знак + - * /';
    $secondNumber = isset($_GET['secondNumber']) ? intval($_GET['secondNumber']) : '';
    if ($sign == '+') {
        $result = $firstNumber + $secondNumber;
    } elseif ($sign == '-') {
        $result = $firstNumber - $secondNumber;
    } elseif ($sign == '*') {
        $result = $firstNumber * $secondNumber;
    } elseif ($sign == '/') {
        $result = $firstNumber / $secondNumber;
    } else {
        $result = 'Нужно ввести знаки +, -, * или /';
    }

    if (isset($_GET['logout']) > 0) {
        $user->logout();
    }

} else {
    header('Location: Lect7/oopCalc/auth.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
</head>
<body>
<form action="calculator.php" method="get">
    <input type="text" name="firstNumber" value="<?= $firstNumber ?>">
    <input style="width: 15px;" type="text" name="sign">
    <input type="text" name="secondNumber" value="<?= $secondNumber ?>">
    <input type="submit" name="equally" value="=">
    <input style="width: 200px" type="text" name="result" value="<?= $result ?>">
</form>
<form action="calculator.php" method="get">
    <input type="submit" name="logout" value="Logout" onclick="location.href='Location: Lect7/oopCalc/auth.php'">
</form>
</body>
</html>
