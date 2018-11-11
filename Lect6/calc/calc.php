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

require_once __DIR__ . '/function.php';

$entryField = isset($_POST['entryField']) ? $_POST['entryField'] : null;
$result = isset($_POST['result']) ? $_POST['result'] : null;

$count = isset($_POST['count']) ? (int)$_POST['count'] : 0;

$lastSign = isset($_POST['lastSign']) ? $_POST['lastSign'] : null;

if (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['split']) || isset($_POST['multiply'])) {
    switch ($_POST['plus'])
}
var_dump($lastSign);
var_dump($_POST);
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
    if (strpos($entryField,'.') === false){
        $entryField .= '.';
    }
}

if (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['split']) || isset($_POST['multiply'])) {
    if (isset($_POST['plus']) && $count > 0){
        $entryField = plus($entryField,$result);
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['plus']) && $count === 0){
        $count++;
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['minus']) && $count > 0){
        $entryField = minus($entryField,$result);
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['minus']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['multiply']) && $count > 0){
        $entryField = multiply($entryField,$result);
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['multiply']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['split']) && $count > 0){
        $entryField = division($entryField,$result);
        $result = $entryField;
        $entryField = null;
    }elseif (isset($_POST['split']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    }
}

if(isset($_POST['clear'])) {
    $entryField = null;
    $result = null;
}

if ($entryField == null && $result == null){
    $showResult = 0;
}elseif ($entryField == null) {
    $showResult = $result;
}else{
    if (isset($_POST['equally'])) {
        switch ($lastSign)
        if ($lastSign == '+'){
            $showResult = plus($entryField,$result);
            $entryField = null;
            $result = null;
        }elseif ($lastSign == '-'){
            $showResult = minus($entryField,$result);
            $entryField = null;
            $result = null;
        }elseif ($lastSign == '*'){
            $showResult = multiply($entryField,$result);
            $entryField = null;
            $result = null;
        }elseif ($lastSign == '/') {
            $showResult = division($entryField,$result);
            $entryField = null;
            $result = null;
        }
    }else{
        $showResult =$entryField;
    }
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
<div style="width: 105px;height: 130px">
    <form action="calc.php" method="post">
        <input type="hidden" name="lastSign" value="<?= $lastSign; ?>">
        <input type="hidden" name="result" value="<?= $result; ?>">
        <input type="hidden" name="count" value="<?= $count; ?>">
        <input type="text" name="entryField" value="<?= $entryField; ?>" placeholder="<?= $showResult; ?>" style="width: 100%">
        <br>
        <input type="submit" name="clear" value="C" style="width: 100%">
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
</div>

<form action="calc.php" method="get">
    <input type="submit" name="logout" value="Logout" onclick="location.href='index.php'">
</form>
</body>
</html>