<?php
header('Content-Type: text/html;charset=utf-8');
error_reporting(E_ALL);
$error = [];
$cols = $rows = 0;
$show = 1;

if (isset($_POST['step1']) && $_POST['step1'])
{
    $rows = isset($_POST['rows']) ? (int)($_POST['rows']) : 0;
    $cols = isset($_POST['cols']) ? intval($_POST['cols']) : 0;
    if ($cols < 1 || $cols > 20)
        $error[] = 'Количество колонок должно быть от 1 до 20. А вы ввели: '.$rows;
    if (!($rows > 0 && $rows < 21))
        $error[] = 'Количество строк должно быть от 1 до 20. А вы ввели: '.$rows;
    if (count($error) == 0) $show = 2;
}
elseif (isset($_POST['step2']) && $_POST['step2'])
{
    $show = 3;
}

?>
<html>
<body>
<?php switch($show) {
    case '2': ?>
<form method="post" action="index.php">
<table width="100%" border="1">
<?php
for ($i = 0; $i < $rows; $i++)
{
    echo '<tr>';
    for ($j = 0; $j < $cols; $j++)
    {
        echo '<td><input type="text" name="row['.$i.']['.$j.']" value="row['.$i.']['.$j.']"></td>';
    }
    echo '</tr>';
}
?>
</table>
<input type="submit" value="OK">
<input type="hidden" name="step2" value="1">
</form>
<?php break;
    case '1':
?>
<?php if (count($error) > 0) echo '<p style="color:red;">'.implode(', ', $error).'</p>'; ?>
<form action="index.php" method="post">
    <table>
        <tr><td>Количество колонок:</td><td><input type="text" name="cols" value="<?= $cols > 0 ? $cols : '' ?>"></td></tr>
        <tr><td>Количество строк:</td><td><input type="text" name="rows" value="<?= $rows > 0 ? $rows : '' ?>"></td></tr>
    </table>
    <input type="submit" value="OK">
    <input type="hidden" name="step1" value="1">
</form>
<?php break;
    case '3':
        echo '<pre>';
        $row = isset($_POST['row']) && is_array($_POST['row']) ? $_POST['row'] : [];
        foreach ($row as $v1)
        {
            if (is_array($v1) && count($v1) > 0)
            {
                echo implode(',', $v1);
                echo "\n";
            }
        }
        echo '</pre>';
        echo '<a href="index2.php">Start again</a>';
        break;
} ?>
</body>
</html>
