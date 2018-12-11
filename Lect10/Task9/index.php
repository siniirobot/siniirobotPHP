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
$page = 1;

$opt = [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    PDO::ATTR_EMULATE_PREPARES => false,
];
$pdo = new PDO($dsn, $user, $pass, $opt);
$lastId = isset($_POST['id']) ? intval($_POST['id']) : null;
try {
    $sql = 'SELECT * FROM animals';
    $stmt = $pdo->query($sql);
    if (isset($_GET['del'])) {
        $pdo->exec('DELETE FROM animals WHERE id = ' . $_GET['del']);
        $_GET['del'] = false;
        header('Location:index.php');
        exit();
    }
    if (!isset($_POST['id'])) {
        $lastId = $pdo->query('SELECT id FROM animals ORDER BY id DESC LIMIT 1');
        $lastId = $lastId->fetch();
        $lastId = $lastId['id'];
        $lastId = $lastId + 1;
    }
    if (isset($_POST['add'])) {
        $name = '\'' . $_POST['name'] . '\'';
        $species = '\'' . $_POST['species'] . '\'';
        $weight = $_POST['weight'];
        $gender = '\'' . $_POST['gender'] . '\'';
        $comments = isset($_POST['comments']) ? htmlspecialchars('\'' . $_POST['comments'] . '\'') : null;
        $pdo->exec("INSERT INTO animals (id,name,species,weight,gender,comments) VALUES 
	($lastId,$name,$species,$weight,$gender,$comments)");
        $lastId = null;
        header('Location:index.php');
        exit();
    }

    if (isset($_GET['edit']) || isset($_POST['save'])) {
        $page = 2;
        $editRow = $pdo->prepare('SELECT * FROM animals WHERE id = ?');
        $editRow->execute([$_GET['edit']]);
        $editRow = $editRow->fetch();
        $lastId = isset($_POST['id']) ? intval($_POST['id']) : $editRow['id'];
        $name = isset($_POST['name']) ? $_POST['name'] : $editRow['name'];
        $species = isset($_POST['species']) ? $_POST['species'] : $editRow['species'];
        $weight = isset($_POST['weight']) ? $_POST['weight'] : $editRow['weight'];
        $gender = isset($_POST['gender']) ? $_POST['gender'] : $editRow['gender'];
        $comments = isset($_POST['comments']) ? $_POST['comments'] : $editRow['comments'];
        if (isset($_POST['save'])) {
            var_dump($editId);
            $pdo->exec("UPDATE animals 
SET 
id = $lastId, 
name =" . '\'' . $name . '\'' . ", 
species =" . '\'' . $species . '\'' . ", 
weight = $weight, 
gender = " . '\'' . $gender . '\'' . " , 
comments = " . '\'' . $comments . '\'' . " 
WHERE id = $editId");
            $page = 2;

        }
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
<?php if ($page == 1) { ?>
    <form action="index.php" method="get">
        <table border="1">
            <thead>
            <tr>
                <td>id</td>
                <td>name</td>
                <td>species</td>
                <td>weight</td>
                <td>gender</td>
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
                echo '<td><form action="index.php" method="get"><a href="index.php?edit=' . $row['id'] . ' ">Редактировать</a></form></td>';
            } ?>
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
                <td><input type="text" name="id" placeholder="<?= $lastId ?>"></td>
            </tr>
            <tr>
                <td>Имя животного</td>
                <td><input type="text" name="name" placeholder="<?= 'Введите имя питомца.' ?>"
                           pattern="^[-А-ЯA-Zа-яa-zЁё\s]+$" required></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="species" placeholder="<?= 'Введите вид питомца.' ?>"
                           pattern="^[-А-ЯA-Zа-яa-zЁё\s]+$" required></td>
            </tr>
            <tr>
                <td>Вес животного</td>
                <td><input type="text" name="weight" placeholder="<?= 'Введите вес питомца.' ?>" pattern="^[0-9]+$"
                           required></td>
            </tr>
            <tr>
                <td>Пол животного</td>
                <td><input type="text" name="gender" placeholder="<?= 'Введите пол питомца в виде М или Ж.' ?>"
                           pattern="[МмЖж]" required></td>
            </tr>
            <tr>
                <td>Комментарии</td>
                <td><input type="text" name="comments" placeholder="<?= 'Комментарии.' ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="add" value="Добавить" style="width: 100%" "></td>
            </tr>
            </tbody>
        </table>
    </form>
<? } else { ?>
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
                <td><input type="text" name="id" value="<?= $lastId ?>">
                </td>
            </tr>
            <tr>
                <td>Имя животного</td>
                <td><input type="text" name="name" value="<?= $name ?>"
                           pattern="^[-А-ЯA-Zа-яa-zЁё\s]+$" required></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="species" value="<?= $species ?>"
                           pattern="^[-А-ЯA-Zа-яa-zЁё\s]+$" required></td>
            </tr>
            <tr>
                <td>Вес животного</td>
                <td><input type="text" name="weight" value="<?= $weight ?>" pattern="^[0-9]+$"
                           required></td>
            </tr>
            <tr>
                <td>Пол животного</td>
                <td><input type="text" name="gender" value="<?= $gender ?>"
                           pattern="[МмЖж]" required></td>
            </tr>
            <tr>
                <td>Комментарии</td>
                <td><input type="text" name="comments" value="<?= $comments ?>"></td>
            </tr>
            <tr>
                <td></td>
                <td><input type="submit" name="save" value="Сохранить" style="width: 100%" "></td>
            </tr>
            </tbody>
        </table>
    </form>
<? } ?>
</body>
</html>