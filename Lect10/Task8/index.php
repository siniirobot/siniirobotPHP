<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 01.12.2018
 * Time: 12:27
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
$minWeight = isset($_GET['minWeight']) ? intval($_GET['minWeight']) > 0 ? intval($_GET['minWeight']) : 0 : null;
$maxWeight = isset($_GET['maxWeight']) ? intval($_GET['maxWeight']) > 0 ? intval($_GET['maxWeight']) : 0 : null;

if (count($_GET) > 0) {
    try {
        if ($minWeight >= 0 && !($maxWeight >= 0)) {
            $sql = '
              SELECT name,weight,nameRUS,nameLAT
              FROM animals AS an
              JOIN animalType AS ty
              WHERE an.specie_id = ty.id AND weight > ?';
            $param = [$minWeight];
        } elseif (!($minWeight >= 0) && $maxWeight >= 0) {
            $sql = '
              SELECT name,weight,nameRUS,nameLAT
              FROM animals AS an
              JOIN animalType AS ty
              WHERE an.specie_id = ty.id AND weight < ?';
            $param = [$maxWeight];

        } elseif ($minWeight > 0 && $maxWeight > 0) {
            $sql = '
              SELECT name,weight,nameRUS,nameLAT
              FROM animals AS an
              JOIN animalType AS ty
              WHERE an.specie_id = ty.id AND weight BETWEEN ? AND ?';
            $param = [$minWeight, $maxWeight];
        }
        if ($sql) {
            $sth = $pdo->prepare($sql, array(PDO::ATTR_CURSOR => PDO::CURSOR_FWDONLY));
            $sth->execute($param);
        }
        if (!$sth || $sth->rowCount() == 0) {
            $error = 'Животных с таким весом нету';
        }
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }
}
?>

<html>
<head>
    <title>Задание 8</title>
</head>
<body>
<form action="index.php" method="get">
    <p>Введите минимальный вес животных.</p>
    <input type="text" name="minWeight" value="<?= $minWeight ?>" style="width: 250px">
    </br>
    <p>Введите максимальный вес животных.</p>
    <input type="text" name="maxWeight" value="<?= $maxWeight ?>" style="width: 250px">
    </br>
    <input type="submit" value="Ок">
</form>
<?php if ($error) {
    echo $error;
} ?>
<?php if ($sth && !($sth->rowCount() == 0)) { ?>
        <table border="1">
            <thead>
            <tr>
                <td>Имя животного</td>
                <td>Вес животного</td>
                <td>Вид животного на русском</td>
                <td>Вид животного на латыни</td>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $sth->fetch()) {
                echo '<tr>';
                foreach ($row as $key){
                    echo '<td>'.$key.'</td>';
                }
                echo '</tr>';
            } ?>
            </tbody>
        </table>
<?php } ?>
</body>
</html>
