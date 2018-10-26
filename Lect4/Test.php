<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 20.10.2018
 * Time: 10:53
 */
header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
$error = [];
$cols = $rows = 0;
$show = 1;

if (isset($_POST['step1']) && $_POST['step1']) {
    $rows = isset($_POST['rows']) ? intval($_POST['rows']) : 0;
    $cols = isset($_POST['cols']) ? intval($_POST['cols']) : 0;

    if (!($cols > 0 && $cols < 21)) {
        $error = 'Количесвто колонок должно быть от 0 до 21. А вы ввели: ' . $cols;
    }
    if (!($rows > 0 && $rows < 21)) {
        $error = 'Количесвто строк должно быть от 0 до 21. А вы ввели: ' . $rows;
    }

    if (count($error) == 0) {
        $show = 2;
    }
} elseif (isset($_POST['step2']) && $_POST['step2']) {
    $show = 3;
}

?>
<html>
<header></header>
<body>
<?php switch ($show) {
    case '2' : ?>
        <form method="post" action="Test.php">
            <table width="100%" border="1px">
                <?php
                for ($i = 0; $i < $rows; $i++) {
                    echo '<tr>';
                    for ($j = 0; $j < $cols; $j++) {
                        echo '<td><input type="text" name="row[' . $i . '][' . $j . ']" value = "' . $i . '" > ';
                    }
                    echo '</tr>';
                }
                ?>
            </table>
            <input type="submit" value="Ок">
            <input type="hidden" name="step2" value="1">
        </form>
        }
        <?php break;
    case '1';
        ?>
        <?php if (count($error) > 0) echo '<p style="color: red">' . implode(', ', $error) . '</p>'; ?>
        <form action="Test.php" method="post">
            <table>
                <tr>
                    <td>Колличество колонок:</td>
                    <td><input type="text" name="colos" value="<?= $cols > 0 ? $cols : '' ?>"></td>
                </tr>
                <tr>
                    <td>Колличество строк:</td>
                    <td><input type="text" name="rows" value="<?= $rows > 0 ? $rows : '' ?>"></td>
            </table>
            <input type="submit" value="Ок">
            <input type="hidden" name="step1" value="1">
        </form>
        <?php break;
    case '3':
        echo '<pre>';
        $row = isset($_POST['row']) && is_array($_POST['row']) ? $_POST['row'] : [];
        foreach ($row as $vl) {
            if (is_array($vl) && count($vl) > 0) {
                echo implode(',', $vl);
                echo "\n";
            }
        }
        echo '</pre>';
        echo '<a href="Test.php">Start again</a>';
        break;
} ?>
</body>
</html>