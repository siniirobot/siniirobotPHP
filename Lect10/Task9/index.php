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
$page1 = true;
$page2 = false;
$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);

try {
    $sql = 'SELECT * FROM animals';
    $stmt = $pdo->query($sql);
    if (isset($_GET['del'])) {
        $pdo->exec('DELETE FROM animals WHERE id = '.$_GET['del']);
        $_GET['del'] = false;
        header('Location:index.php');
        exit();
    }
    if (isset($_POST['add'])){
        $lastId = $_POST['id'];
        if (isset($_POST['id'])){
            $lastId = $pdo->query('SELECT id FROM animals ORDER BY id DESC LIMIT 1');
            $lastId = $lastId->fetch();
            $lastId = $lastId['id'];
            $lastId = $lastId + 1;
        }
        $name ='\''. $_POST['name'].'\'';
        $species = $_POST['species'];
        $weight = $_POST['weight'];
        $gender = '\''. $_POST['gender'].'\'';
        $specie_id = $_POST['specie_id'];
        $comments ='\''.  $_POST['comments'].'\'';
        //var_dump($lastId, $name,$species,$weight,$gender,$specie_id,$comments);
        //$pdo->exec('INSERT INTO animals (id,name,species,weight,gender,specie_id,comments) VALUES ('.$lastId.','.$name.','.$species.','.$weight.','.$gender.','.$specie_id.','.$comments.')');
        $pdo->exec("INSERT INTO animals (id,name,species,weight,gender,specie_id,comments) VALUES 
	($lastId,$name,$species,$weight,$gender,$specie_id,$comments)");
        header('Location:index.php');
        exit();
    }
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
                <td>Редактирование</td>
            </tr>
            </thead>
            <tbody>
            <?php while ($row = $stmt->fetch()) {

                echo '<tr>';
                foreach ($row as $key) {
                    echo '<td>' . $key . '</td>';
                }
                echo '<td><form action="index.php" method="get"><a href="index.php?del= ' . $row['id'] . '">Удалить</a></form></td>';
                echo '<td><form action="index.php" </td>';
            } ?>
            <?php

            ?>
            </tbody>
        </table>
    </form>
    <form action="index.php" method="post">
        <table border="1">
            <thead>
            <tr>
                <td>Название поля</td>
                <td>Поле ввода</td>
            </tr>
            </thead>
            <tbody>
            <tr>
                <td>Id</td>
                <td><input type="text" name="id"></td>
            </tr>
            <tr>
                <td>Имя животного</td>
                <td><input type="text" name="name"></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="species"></td>
            </tr>
            <tr>
                <td>Вес животного</td>
                <td><input type="text" name="weight"></td>
            </tr>
            <tr>
                <td>Пол животного</td>
                <td><input type="text" name="gender"></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="specie_id"></td>
            </tr>
            <tr>
                <td>Комментарии</td>
                <td><input type="text" name="comments"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="add" value="Добавить" style="width: 100%" "></td>
            </tr>
            </tbody>
        </table>
    </form>
    </body>
    </html>