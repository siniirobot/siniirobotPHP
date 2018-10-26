<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 26.10.2018
 * Time: 13:35
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);
$rowsCount = isset($_POST['rowsCount']) ? intval($_POST['rowsCount']) : 0;
$columnsCount = isset($_POST['columnsCount']) ? intval($_POST['columnsCount']) : 0;

$step = 1;
$errors = [];

if (isset($_POST['step1']) && $_POST['step1']){
    if ($rowsCount < 1 || $rowsCount > 20) {
        $errors[] = 'Число строк должно быть от одного до 20. А вы ввели: '.$rowsCount;
    }
    if ($columnsCount < 1 || $columnsCount > 20) {
        $errors[] = 'Число колонок должно быть от одного до 20 А вы ввели: '.$columnsCount;
    }
    if(count($errors) == 0) {
        $step = 2;
    }
}elseif (isset($_POST['step2']) && $_POST['step2']) {
    $step = 3;
}

?>
<!DOCTYPE html>
<html>
<head>
    <title>CSV страница 1</title>
</head>
<body>
    <?php foreach ($errors as $vl){ ?>
        <p style="color: red"><?php echo  $vl; ?></p>
    <?php } ?>

    <?php if ($step == 1) {?>
        <form action="CSV.php" method="post">
            <table>
                <tr>
                    <td>Число строк:</td>
                    <td>
                        <input type="text" name="rowsCount" value="<?= $rowsCount > 0 ? $rowsCount : '†' ?>">
                    </td>
                </tr>
                <tr>
                    <td>Число столбцов:</td>
                    <td>
                        <input type="text" name="columnsCount" value="<?= $columnsCount > 0 ? $columnsCount : '†' ?>">
                    </td>
                </tr>
            </table>
            <input type="submit" value="OK">
            <input type="hidden" name="step1" value="OK">
        </form>
    <?php } elseif ($step == 2) { ?>
        <form action="CSV.php" method="post">
            <table width="50%" border="3" bgcolor="aqua">
                <?php for ($i = 0; $i < $rowsCount; $i++){ ?>
                    <tr>
                    <?php for ($j = 0; $j < $columnsCount; $j++){
                        echo '<td><input type="text" name="row[' . $i . '][' . $j . ']" value = "' . $i .'.'. $j .  '" > ';
                    } ?>
                    </tr>
                <?php } ?>
            </table>
            <input type="submit" value="OK">
            <input type="hidden" name="step2" value="OK">
        </form>
    <?php } elseif ($step == 3) {
        echo '<pre>';

        $rows = isset($_POST['row']) && is_array($_POST['row']) ? $_POST['row'] : [];

        foreach ($rows as $vl) {
            if (is_array($vl) && count($vl) > 0) {
                echo implode(',', $vl);
                echo "\n";
            }
        }
        echo '</pre>';
        echo '<a href="Test.php">Start again</a>';
     } ?>
</body>
</html>
