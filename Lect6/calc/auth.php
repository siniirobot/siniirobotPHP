<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 09.11.2018
 * Time: 10:40
 */
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

session_start();
require_once __DIR__ . '/function.php';

$error = null;

if (count($_POST) > 0) {
    $login = $_POST['login'];
    $pass = $_POST['pass'];

    if (auth($login, $pass)) {
        header('Location: calc.php');
        exit();
    } else {
        $error = 'Введите верные данные';
        session_destroy();
    }
}
if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    $login = $_SESSION['login'];
    $pass = $_SESSION['pass'];
    if (auth($login,$pass) == true) {
        header('Location: calc.php');
        exit();
    }
}
?>


<html>
<head>
    <title>
        Авторизация
    </title>
</head>
<body>
<p><?= $error ?></p>
<form action="auth.php" method="post">
    <p><input type="text" name="login" placeholder="Введите логин"></p>
    <p><input type="password" name="pass" placeholder="Введите пароль"></p>
    <p><input type="submit" value="Login"></p>
</form>
</body>
</html>