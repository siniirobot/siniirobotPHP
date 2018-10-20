<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 20.10.2018
 * Time: 10:53
 */
header('Content-Type: text/html; charset=utf-8');
//Форма с двумя столбцами с ячейками столбцы и строки и нарисовать с проверкой.
$error = [];
$cols = $lines = 0;
$showForm = false;
if (isset($_POST['step1']) && $_POST['step1'])
{
    $column = isset($_POST['column']) ? intval($_POST['column']) : 0;
    $lines = isset($_POST['lines']) ? intval($_POST['lines']) : 0;

    if (!($column > 0 && $column < 21)) {
        $error = "Количесвто колонок должно быть от 0 до 21. А вы ввели $column";
}
    if (!($column > 0 && $lines < 21)) {
        $error = "Количесвто строк должно быть от 0 до 21. А вы ввели $lines";
    }

    if (count($error) == 0) {
        $showForm = true;
    }
}
?>
<html>
<header></header>
<body>

    <?php if ($showForm): ?>
    <table width="100%" border="1px">
        <?php
            for ($i = 0; $i < $lines; $i++) {
                echo '<tr>';
                for ($j = 0; $j < $column; $j++) {
                    echo '<td><input type="text" name="row['.$i.']['.$j.']" value = "'.$i.'" > ';
                }
            }
        ?>
    </table>
    <? if (count($error)>0) echo "<p style= color:red;">.implode()?>
    <form action="Test.php" method="post">
        <label>
            Количество колонок: <input type="text" name="column" value="<? $column ?>">
        </label>
        </br>
        <label>
            Количесвто строк: <input type="text" name="lines" value="<? $lines ?>">
        </label>
        </br>
        <input type="submit" value="Ок">
        <input type="hidden" name="step1" value="1">
    </form>
</body>
</html>