<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 31.10.2018
 * Time: 20:41
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

session_start();

if (count($_GET) > 0){
    session_destroy();
    header('Location:index.php');
    exit();
}
?>

<html>
<head>
    <title>Личный кабинет</title>
</head>
<body>
    <p>Поздравляю путник ты достиг точки назначения</p>
    <form action="home.php" method="get">
        <input type="submit" name="logout" value="Logout" onclick="location.href='index.php'">
    </form>
</body>
</html>
