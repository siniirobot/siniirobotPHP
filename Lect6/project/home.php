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

var_dump($_GET);
var_dump($_SESSION);
if (isset($_GET['logout']) && $_GET['logout']){
    session_destroy();


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
