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

$firstNumber = isset($_POST['firstNumber']) ? $_POST['firstNumber'] : null;
$secondNumber = isset($_POST['secondNumber']) ? $_POST['secondNumber'] : null;
$showResult = isset($showResult) ? $showResult : $firstNumber;
$count = isset($_POST['count']) ? (int)$_POST['count'] : 0;

$lastSign = isset($_POST['lastSign']) ? $_POST['lastSign'] : null;

if (isset($_POST['seven'])) {
    $firstNumber .= 7;
}
if (isset($_POST['eight'])) {
    $firstNumber .= 8;
}
if (isset($_POST['nine'])) {
    $firstNumber .= 9;
}
if (isset($_POST['four'])) {
    $firstNumber .= 4;
}
if (isset($_POST['five'])) {
    $firstNumber .= 5;
}
if (isset($_POST['six'])) {
    $firstNumber .= 6;
}
if (isset($_POST['one'])) {
    $firstNumber .= 1;
}
if (isset($_POST['two'])) {
    $firstNumber .= 2;
}
if (isset($_POST['three'])) {
    $firstNumber .= 3;
}
if (isset($_POST['zero'])) {
    $firstNumber .= 0;
}
if (isset($_POST['point'])) {
    if (strpos($firstNumber, '.') === false) {
        $firstNumber .= '.';
    }
}

if (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division']) || isset($_POST['multiply'])) {
    echo 'меню выбора';
    if (isset($_POST['plus']) && $count === 0) {
        echo 'первый плюс';
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count++;
        $lastSign = '+';
    }elseif ($count > 0 && $lastSign == '+') {
        $showResult = plus($firstNumber,$secondNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    }

    if (isset($_POST['minus']) && $count === 0) {
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count++;
        $lastSign = '-';
    }elseif ($count > 0 && $lastSign == '-') {
        $showResult = minus($secondNumber,$firstNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
        var_dump($showResult);
    }

}

if (isset($_POST['clear'])) {
    $firstNumber = null;
    $secondNumber = null;
    $count = 0;
    $lastSign = null;
    $showResult = null;
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
            <input type="hidden" name="firstNumber" value="<?= $firstNumber; ?>">
            <input type="hidden" name="secondNumber" value="<?= $secondNumber; ?>">
            <input type="hidden" name="count" value="<?= $count; ?>">
            <input type="text" name="entryField"  value="<?= $firstNumber; ?>" placeholder="<?= $showResult; ?>" style="width: 100%">
            <br>
            <input type="submit" name="clear" value="C" style="width: 100%">
            <br>
            <input type="submit" name="seven" value="7">
            <input type="submit" name="eight" value="8">
            <input type="submit" name="nine" value="9">
            <input type="submit" name="division" value="/">
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

<?php
/*if (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['split']) || isset($_POST['multiply'])) {
    if (isset($_POST['plus']) && $count > 0) {
        $entryField = plus($entryField, $result);
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['plus']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['minus']) && $count > 0) {
        $entryField = minus($entryField, $result);
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['minus']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['multiply']) && $count > 0) {
        $entryField = multiply($entryField, $result);
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['multiply']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['split']) && $count > 0) {
        $entryField = division($result, $entryField);
        $result = $entryField;
        $entryField = null;
    } elseif (isset($_POST['split']) && $count === 0) {
        $count++;
        $result = $entryField;
        $entryField = null;
    }
}

if (isset($_POST['clear'])) {
    $entryField = null;
    $result = null;
    $count = 0;
    $lastSign = null;
}

if ($entryField == null && $result == null) {
    $showResult = 0;
} elseif ($entryField == null) {
    $showResult = $result;
} else {
    if (isset($_POST['equally'])) {
        switch ($lastSign) {
            case '+':
                $showResult = plus($entryField, $result);
                $result = null;
                break;
            case '-':
                $showResult = minus($entryField, $result);
                $result = null;
                break;
            case '*':
                $showResult = multiply($entryField, $result);
                $result = null;
                break;
            case '/':
                $showResult = division($result, $entryField);
                $result = null;
                break;
        }
    } else {
        $showResult = $entryField;
    }
}
*/