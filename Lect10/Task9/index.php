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

try {
    $sql = 'SELECT * FROM animals';
    $stmt = $pdo->prepare($sql);
    $stmt->execute();
    if (isset($_GET['del'])) {
        $del = $pdo->prepare('DELETE FROM animals WHERE id = ?');
        $del->execute([$_GET['del']]);
        $_GET['del'] = false;
        header('Location:index.php');
        exit();
    }
    if (isset($_POST['add'])) {
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : null;
        $species = isset($_POST['species']) ? htmlspecialchars($_POST['species']) : null;;
        $weight = isset($_POST['weight']) ? intval($_POST['name']) : null;;
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : null;
        $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : null;
        $insert = $pdo->prepare('INSERT INTO animals (name,species,weight,gender,comments) VALUES 
	(?,?,?,?,?)');
        $insert->execute([$name, $species, $weight, $gender, $comments]);
        header('Location:index.php');
        exit();
    }

    if (isset($_GET['edit']) || isset($_POST['save'])) {
        if (isset($_GET['edit'])) {
            $checkId = $_GET['edit'];
        }
        $page = 2;
        $editRow = $pdo->prepare('SELECT * FROM animals WHERE id = ?');
        $editRow->execute([isset($_POST['save_id']) ? intval($_POST['save_id']) : $checkId]);
        $editRow = $editRow->fetch();
        $name = isset($_POST['name']) ? htmlspecialchars($_POST['name']) : $editRow['name'];
        $species = isset($_POST['species']) ? htmlspecialchars($_POST['species']) : $editRow['species'];
        $weight = isset($_POST['weight']) ? intval($_POST['weight']) : $editRow['weight'];
        $gender = isset($_POST['gender']) ? htmlspecialchars($_POST['gender']) : $editRow['gender'];
        $comments = isset($_POST['comments']) ? htmlspecialchars($_POST['comments']) : $editRow['comments'];
        if (isset($_POST['save'])) {
            $update = $pdo->prepare('UPDATE animals 
    SET name =?,
        species =?,
        weight =?,
        gender =?,
        comments =? 
    WHERE id = ?;');
            $update->execute([$name, $species, $weight, $gender, $comments, $_POST['save_id']]);
            $page = 1;
            header('Location:index.php');
            exit();

        }
    }
} catch (PDOException $e) {
    echo 'Подключение не удалось: ' . $e->getMessage();
}
?>

<html>
<head>
    <title>Задание 9</title>
    <style>
        input {
            width: 300px;
            border: none;
            outline: none;
        }

    </style>
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
                <td>Имя животного</td>
                <td><input type="text" name="name" placeholder="<?= 'Введите имя питомца.' ?>"
                           required></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="species" placeholder="<?= 'Введите вид питомца.' ?>"
                           required></td>
            </tr>
            <tr>
                <td>Вес животного</td>
                <td><input type="text" name="weight" placeholder="<?= 'Введите вес питомца в граммах целым числом.' ?>"
                           required></td>
            </tr>
            <tr>
                <td>Пол животного</td>
                <td><input type="text" name="gender" placeholder="<?= 'Введите пол питомца в формате М или Ж.' ?>"
                           required></td>
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
            <input type="hidden" name="save_id" value="<?= $checkId ?>">

            <tr>
                <td>Имя животного</td>
                <td><input type="text" name="name" value="<?= $name ?>"
                           required></td>
                <td><p>Введите имя питомца.</p></td>
            </tr>
            <tr>
                <td>Вид животного</td>
                <td><input type="text" name="species" value="<?= $species ?>"
                           required></td>
                <td><p>Введите вид питомца.</p></td>
            </tr>
            <tr>
                <td>Вес животного</td>
                <td><input type="text" name="weight" value="<?= $weight ?>"
                           required></td>
                <td><p>Введите вес питомца в граммах целым числом.</p></td>
            </tr>
            <tr>
                <td>Пол животного</td>
                <td><input type="text" name="gender" value="<?= $gender ?>"
                           required></td>
                <td><p>Введите пол питомца в формате М или Ж.</p></td>
            </tr>
            <tr>
                <td>Комментарии</td>
                <td><input type="text" name="comments" value="<?= $comments ?>"></td>
                <td><p>Комментарии.</p></td>
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