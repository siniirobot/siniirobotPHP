<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 09.11.2018
 * Time: 10:41
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

session_start();

$entryField = isset($_POST['entryField']) ? intval($_POST['entryField']) : '';
$result = isset($_POST['result']) ? intval($_POST['result']) : '';

if (isset($_POST['seven'])) {
    $entryField .= 7;
}
if (isset($_POST['eight'])) {
    $entryField .= 8;
}
if (isset($_POST['nine'])) {
    $entryField .= 9;
}
if (isset($_POST['four'])) {
    $entryField .= 4;
}
if (isset($_POST['five'])) {
    $entryField .= 5;
}
if (isset($_POST['six'])) {
    $entryField .= 6;
}
if (isset($_POST['one'])) {
    $entryField .= 1;
}
if (isset($_POST['two'])) {
    $entryField .= 2;
}
if (isset($_POST['three'])) {
    $entryField .= 3;
}
if (isset($_POST['zero'])) {
    $entryField .= 0;
}
if (isset($_POST['point'])) {
    $entryField .= '.';
    var_dump($entryField);
}
if (isset($_POST['plus'])) {
    $result = $entryField;
    $entryField = 0;
}

if (isset($_POST['equally'])) {
    $entryField += $result;
    $result = 0;
}

if (isset($_GET['logout']) > 0) {
    session_destroy();
    header('Location:auth.php');
    exit();
}
?>

<html>
<head>
    <title>Личный кабинет</title>
</head>
<body>
<form action="calc.php" method="post">
    <input type="hidden" name="result" value="<?= $result; ?>">
    <input type="text" name="entryField" value="<?= $entryField; ?>" placeholder="0">
    <br>
    <input type="submit" name="seven" value="7">
    <input type="submit" name="eight" value="8">
    <input type="submit" name="nine" value="9">
    <input type="submit" name="split" value="/">
    <br>
    <input type="submit" name="four" value="4">
    <input type="submit" name="five" value="5">
    <input type="submit" name="six" value="6">
    <input type="submit" name="multiply" value="*">
    <br>
    <input type="submit" name="one" value="1">
    <input type="submit" name="two" value="2">
    <input type="submit" name="three" value="3">
    <input type="submit" name="minus" value="-">
    <br>
    <input type="submit" name="zero" value="0">
    <input type="submit" name="point" value=".">
    <input type="submit" name="plus" value="+">
    <input type="submit" name="equally" value="=">
</form>
<form action="calc.php" method="get">
    <input type="submit" name="logout" value="Logout" onclick="location.href='index.php'">
</form>
</body>
</html>