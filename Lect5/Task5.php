<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 30.10.2018
 * Time: 15:49
 */

header('Content-Type: test/html; charset=utf-8');
error_reporting(E_ALL);

$fp = fopen('users.csv', 'rb');

while (($data = fgetcsv($fp, 1000, ",")) !== FALSE) {
    echo $data[0].' '.$data[1].' '.$data[2].' '.$data[3].'</br>';
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>20 на странице</title>
</head>
<body>

</body>
</html>
