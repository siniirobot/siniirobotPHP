<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 01.12.2018
 * Time: 12:27
 */

/* Подключение к базе данных MySQL с помощью вызова драйвера */
$dsn = 'mysql:dbname=clinic;host=127.0.0.1:3307';
$user = 'root';
$password = '';

try {
    $dbh = new PDO($dsn, $user, $password);
    $sql = 'SELECT *
    FROM animals';
    $sth = $dbh->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
   print_r($sth);
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
