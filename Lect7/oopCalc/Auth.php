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
require_once __DIR__ . ' /Classes/User.php';
require_once __DIR__ . ' /Classes/Session.php';

$user = new User();

if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    $session = new Session();
    if ($user->check($session->get('login'), $session->get('pass'))) {
        header('Location: /Lect7/oopCalc/Calculator.php');
        exit();
    } else {
        echo 'Введите верные даные';
        $session->destroy();
    }
}

if (count($_POST) > 0) {
    $user->login($_POST['login'], $_POST['pass']);
}
?>

<html>
<head>
    <title>
        Авторизация
    </title>
</head>
<body>
<form action="Auth.php" method="post">
    <p><input type="text" name="login" placeholder="Введите логин"></p>
    <p><input type="password" name="pass" placeholder="Введите пароль"></p>
    <p><input type="submit" value="Login"></p>
</form>
</body>
</html>