<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 28.10.2018
 * Time: 20:41
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

$line = isset($_POST['line']) ? $_POST['line'] : '';

function changeLine($line)
{
    $outputLine = '';
    if (isset($line)) {
        $patterns =  array(
            'дурак',
            'лох',
            'казел',
            'туниядец',
            'алкоголик',
            'разгильдяй',
            );

        $replacement = '*****';

        $outputLine = str_ireplace($patterns,$replacement, $line);
    }
    return $outputLine;
}

?>

<!DOCTYPE html>
<html>
<head>
    <title>Плохие члова исчезните</title>
</head>
<body>
    <form action="Task1.php" method="post">
        <input type="text" name="line" value="" placeholder="Введи строку с плохими словами">
        <input type="submit" value="Изменить строку">
    </form>
    <?php echo changeLine($line) ?>
</body>
</html>
