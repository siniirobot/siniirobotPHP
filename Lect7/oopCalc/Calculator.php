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

if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    require_once __DIR__ . '/Classes/User.php';
    require_once __DIR__ . '/Classes/MathematicalExpressions.php';
    require_once __DIR__ . '/Classes/Session.php';

    $user = new User();
    $math = new MathematicalExpressions();
    $session = new Session();

    if ($user->check($session->get('login'), $session->get('pass'))) {

        $firstNumber = isset($_GET['firstNumber']) ? intval($_GET['firstNumber']) : '';
        $sign = isset($_GET['sign']) ? htmlspecialchars($_GET['sign']) : 'Введите знак + - * /';
        $secondNumber = isset($_GET['secondNumber']) ? intval($_GET['secondNumber']) : '';

        if ($sign === '+') {
            $result = $math->addition($firstNumber, $secondNumber);
        } elseif ($sign === '-') {
            $result = $math->subtraction($firstNumber, $secondNumber);
        } elseif ($sign === '*') {
            $result = $math->multiplication($firstNumber, $secondNumber);
        } elseif ($sign === '/') {
            $result = $math->division($firstNumber, $secondNumber);
        } else {
            $result = 'Нужно ввести знаки +, -, * или /';
        }

        if (isset($_GET['logout'])) {
            $user->logout();
        }
    } else {
        $session->destroy();
    }

} else {
    header('Location: /Lect7/oopCalc/Auth.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Калькулятор</title>
</head>
<body>
<form action="Calculator.php" method="get">
    <input type="text" name="firstNumber" value="<?= $firstNumber ?>">
    <input style="width: 15px;" type="text" name="sign">
    <input type="text" name="secondNumber" value="<?= $secondNumber ?>">
    <input type="submit" name="equally" value="=">
    <input style="width: 200px" type="text" name="result" value="<?= $result ?>">
</form>
<form action="Calculator.php" method="get">
    <input type="submit" name="logout" value="Logout"">
</form>
</body>
</html>
