<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 07.12.2018
 * Time: 14:09
 */

$host = '127.0.0.1:3307';
$db = 'clinic';
$user = 'root';
$pass = '';
$charset = 'utf8';

$dsn = "mysql:dbname=$db;host=$host;charset=$charset";

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

try {
    $sql = 'SELECT * FROM animals';
    $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
    $stmt = $pdo->query('SELECT * FROM animals');
    echo $stmt->rowCount();
    echo $sth->rowCount();
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>

<html>
<head>
    <title>Задание 9</title>
</head>
<body>
<form action="index.php" method="get">
    <table border="1">
        <thead>
        <tr>
            <td>id</td>
            <td>name</td>
            <td>species</td>
            <td>weight</td>
            <td>gender</td>
            <td>specie_id</td>
            <td>comments</td>
            <td>Удаление</td>
        </tr>
        </thead>
        <tbody>
        <?php while ($row = $stmt->fetch()) {
            echo '<tr>';
            foreach ($row as $key) {
                echo '<td>' . $key . '</td>';
            }
            echo '<td><input type="submit" value="Удалить" name="' . $row['id'] . '"></td></tr>';
        } ?>
        </tbody>
    </table>
</form>
</body>
</html>
