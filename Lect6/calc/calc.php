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
$count = isset($_POST['count']) ? $_POST['count'] : false;
$lastSign = isset($_POST['lastSign']) ? $_POST['lastSign'] : null;
$equal = isset($_POST['lastEqual']) ? $_POST['lastEqual'] : false;

if (isset($_POST['clear'])) {
    $firstNumber = null;
    $secondNumber = null;
    $count = false;
    $lastSign = null;
    $showResult = null;
}

if (($equal && isset($_POST['seven'])) || ($equal && isset($_POST['eight'])) || ($equal && isset($_POST['nine'])) ||
    ($equal && isset($_POST['six'])) || ($equal && isset($_POST['five'])) || ($equal && isset($_POST['four'])) ||
    ($equal && isset($_POST['three'])) || ($equal && isset($_POST['two'])) || ($equal && isset($_POST['one']))) {
    $secondNumber = null;
    $count = false;
    $lastSign = null;
    $showResult = null;
    $equal = false;
}

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

if (isset($_POST['changeSign'])) {
    if ($firstNumber == null) {
        $secondNumber *= -1;
    } else {
        $firstNumber *= -1;
    }
}

if ($lastSign != null && (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division']) || isset($_POST['multiply']))) {
    $equal = false;
    if ($count && $lastSign == '+') {
        if (!(isset($_POST['plus']))) {
            if (isset($_POST['minus'])) {
                $lastSign = '-';
                $showResult = $showResult = plus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                $lastSign = '/';
                $showResult = plus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['multiply'])) {
                $lastSign = '*';
                $showResult = plus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = plus($firstNumber, $secondNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
        }

    } elseif ($count && $lastSign == '-') {
        if (!(isset($_POST['minus']))) {
            if (isset($_POST['plus'])) {
                $lastSign = '+';
                $showResult = minus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                $lastSign = '/';
                $showResult = minus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['multiply'])) {
                $lastSign = '*';
                $showResult = minus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = minus($secondNumber, $firstNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
        }
    } elseif ($count && $lastSign == '/') {
        if (!isset($_POST['division'])) {
            if (isset($_POST['plus'])) {
                $lastSign = '+';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['minus'])) {
                $lastSign = '-';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['multiply'])) {
                $lastSign = '*';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            }
        } else {
            if ($firstNumber === 0) {
                $showResult = 'Деление на ноль невозможно';
                $firstNumber = null;
                $secondNumber = null;
                $lastSign = null;
                $count = false;
            } elseif ($firstNumber != null) {
                $showResult = division($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        }
    } elseif ($count && $lastSign == '*') {
        if (!(isset($_POST['multiply']))) {
            if (isset($_POST['plus'])) {
                $lastSign = '+';
                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['minus'])) {
                $lastSign = '-';
                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                $lastSign = '/';
                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        }
    } else {
        $showResult = multiply($firstNumber, $secondNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    }
}

if ($lastSign == null && (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division'])
        || isset($_POST['multiply'])) && !$count) {

    if (isset($_POST['plus'])) {
        $lastSign = '+';
    } elseif (isset($_POST['minus'])) {
        $lastSign = '-';
    } elseif (isset($_POST['division'])) {
        $lastSign = '/';
    } elseif (isset($_POST['multiply'])) {
        $lastSign = '*';
    }

    $secondNumber = $firstNumber;
    $firstNumber = null;
    $count = true;
    $equal = false;
}

if (isset($_POST['equally'])) {
    switch ($lastSign) {
        case '+':
            $showResult = plus($firstNumber, $secondNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
            break;
        case '-':
            $showResult = minus($secondNumber, $firstNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
            break;
        case '/':
            if ($firstNumber == 0) {
                $showResult = 'Деление на ноль невозможно';
                $firstNumber = null;
                $secondNumber = null;
                $lastSign = null;
                $count = false;
            } else {
                $showResult = division($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
            break;
        case '*':
            $showResult = multiply($secondNumber, $firstNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
            break;
    }
    $equal = true;
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
    <div style="width: 105px;height: 150px">
        <form action="calc.php" method="post">
            <input type="hidden" name="lastEqual" value="<?= $equal; ?>">
            <input type="hidden" name="lastSign" value="<?= $lastSign; ?>">
            <input type="hidden" name="firstNumber" value="<?= $firstNumber; ?>">
            <input type="hidden" name="secondNumber" value="<?= $secondNumber; ?>">
            <input type="hidden" name="count" value="<?= $count; ?>">
            <input type="text" name="entryField" value="<?= $firstNumber; ?>" placeholder="<?= $showResult; ?>"
                   style="width: 100%">
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
            <input type="submit" name="changeSign" value="-/+" style="width: 100%">
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

/*
 * второй вариант
 * if ($lastSign == '+') {
        echo 'Равно плюс ' . $lastSign . '</br>';
        echo 'Равно плюс ' . $firstNumber . '</br>';
        echo 'Равно плюс ' . $secondNumber . '</br>';
        echo 'Равно плюс ' . $showResult . '</br>';
        $showResult = plus($firstNumber, $secondNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    } elseif ($lastSign == '-') {
        echo 'Равно минус ' . $lastSign . '</br>';
        echo 'Равно минус ' . $firstNumber . '</br>';
        echo 'Равно минус ' . $secondNumber . '</br>';
        echo 'Равно минус ' . $showResult . '</br>';
        $showResult = minus($secondNumber, $firstNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    } elseif ($lastSign == '/') {
        echo 'Равно деление ' . $lastSign . '</br>';
        echo 'Равно деление ' . $firstNumber . '</br>';
        echo 'Равно деление ' . $secondNumber . '</br>';
        echo 'Равно деление ' . $showResult . '</br>';
        if ($firstNumber == 0) {
            $showResult = 'Деление на ноль невозможно';
            $firstNumber = null;
            $secondNumber = null;
            $lastSign = null;
            $count = false;
        } else {
            $showResult = division($secondNumber, $firstNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
        }
    } elseif ($lastSign == '*') {
        echo 'Равно умножить ' . $lastSign . '</br>';
        echo 'Равно умножить  ' . $firstNumber . '</br>';
        echo 'Равно умножить  ' . $secondNumber . '</br>';
        echo 'Равно умножить  ' . $showResult . '</br>';
        $showResult = multiply($secondNumber, $firstNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    }

    if (isset($_POST['plus']) && !$count) {
        echo 'Первый плюс ' . $lastSign . '</br>';
        echo 'Первый плюс ' . $firstNumber . '</br>';
        echo 'Первый плюс ' . $secondNumber . '</br>';
        echo 'Первый плюс ' . $showResult . '</br>';
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count = true;
        $lastSign = '+';
    } elseif (isset($_POST['minus']) && !$count) {
        echo 'Первый минус ' . $lastSign . '</br>';
        echo 'Первый минус ' . $firstNumber . '</br>';
        echo 'Первый минус ' . $secondNumber . '</br>';
        echo 'Первый минус ' . $showResult . '</br>';
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count = true;
        $lastSign = '-';
    } elseif (isset($_POST['division']) && !$count) {
        echo 'Первое деление ' . $lastSign . '</br>';
        echo 'Первое деление' . $firstNumber . '</br>';
        echo 'Первое деление' . $secondNumber . '</br>';
        echo 'Первое деление' . $showResult . '</br>';
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count = true;
        $lastSign = '/';
    } elseif (isset($_POST['multiply']) && !$count) {
        echo 'Первое умножение ' . $lastSign . '</br>';
        echo 'Первое умножение' . $firstNumber . '</br>';
        echo 'Первое умножение' . $secondNumber . '</br>';
        echo 'Первое умножение' . $showResult . '</br>';
        $secondNumber = $firstNumber;
        $firstNumber = null;
        $count = true;
        $lastSign = '*';
    }


if ($lastSign != null && (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division']) || isset($_POST['multiply']))) {
    $equal = false;
    if ($count && $lastSign == '+') {
        echo 'второй плюс ' . $lastSign . '</br>';
        echo 'второй плюс ' . $firstNumber . '</br>';
        echo 'второй плюс ' . $secondNumber . '</br>';
        echo 'второй плюс ' . $showResult . '</br>';
        if (!(isset($_POST['plus']))) {
            if (isset($_POST['minus'])) {
                echo 'второй плюс на минус' . $lastSign . '</br>';
                echo 'второй плюс на минус ' . $firstNumber . '</br>';
                echo 'второй плюс на минус ' . $secondNumber . '</br>';
                echo 'второй плюс на минус ' . $showResult . '</br>';
                $lastSign = '-';
                $showResult = $showResult = plus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                echo 'второй плюс на деление ' . $lastSign . '</br>';
                echo 'второй плюс на деление ' . $firstNumber . '</br>';
                echo 'второй плюс на деление ' . $secondNumber . '</br>';
                echo 'второй плюс на деление ' . $showResult . '</br>';
                $lastSign = '/';

                $showResult = plus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;

            } elseif (isset($_POST['multiply'])) {
                echo 'второй плюс на умножить' . $lastSign . '</br>';
                echo 'второй плюс на умножить ' . $firstNumber . '</br>';
                echo 'второй плюс на умножить ' . $secondNumber . '</br>';
                echo 'второй плюс на умножить ' . $showResult . '</br>';
                $lastSign = '*';
                $showResult = plus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = plus($firstNumber, $secondNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
        }

    } elseif ($count && $lastSign == '-') {
        echo 'второй минус ' . $lastSign . '</br>';
        echo 'второй минус ' . $firstNumber . '</br>';
        echo 'второй минус ' . $secondNumber . '</br>';
        echo 'второй минус ' . $showResult . '</br>';
        if (!(isset($_POST['minus']))) {
            if (isset($_POST['plus'])) {
                echo 'второй минус на плюс ' . $lastSign . '</br>';
                echo 'второй минус на плюс ' . $firstNumber . '</br>';
                echo 'второй минус на плюс ' . $secondNumber . '</br>';
                echo 'второй минус на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                $showResult = minus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                echo 'второй минус на деление ' . $lastSign . '</br>';
                echo 'второй минус на деление ' . $firstNumber . '</br>';
                echo 'второй минус на деление ' . $secondNumber . '</br>';
                echo 'второй минус на деление ' . $showResult . '</br>';
                $lastSign = '/';

                $showResult = minus($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;

            } elseif (isset($_POST['multiply'])) {
                echo 'второй минус на умножить' . $lastSign . '</br>';
                echo 'второй минус на умножить ' . $firstNumber . '</br>';
                echo 'второй минус на умножить ' . $secondNumber . '</br>';
                echo 'второй минус на умножить ' . $showResult . '</br>';
                $lastSign = '*';
                $showResult = minus($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = minus($secondNumber, $firstNumber);
            $secondNumber = $showResult;
            $firstNumber = null;
        }
    } elseif ($count && $lastSign == '/') {
        echo 'второе деление ' . $lastSign . '</br>';
        echo 'второе деление ' . $firstNumber . '</br>';
        echo 'второе деление ' . $secondNumber . '</br>';
        echo 'второе деление ' . $showResult . '</br>';
        if (!isset($_POST['division'])) {
            if (isset($_POST['plus'])) {
                echo 'второй деление на плюс ' . $lastSign . '</br>';
                echo 'второй деление на плюс ' . $firstNumber . '</br>';
                echo 'второй деление на плюс ' . $secondNumber . '</br>';
                echo 'второй деление на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['minus'])) {
                echo 'второй деление на минус' . $lastSign . '</br>';
                echo 'второй деление на минус ' . $firstNumber . '</br>';
                echo 'второй деление на минус ' . $secondNumber . '</br>';
                echo 'второй деление на минус ' . $showResult . '</br>';
                $lastSign = '-';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['multiply'])) {
                echo 'второй деление на умножить' . $lastSign . '</br>';
                echo 'второй деление на умножить ' . $firstNumber . '</br>';
                echo 'второй деление на умножить ' . $secondNumber . '</br>';
                echo 'второй деление на умножить ' . $showResult . '</br>';

                $lastSign = '*';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            }
        } else {
            if ($firstNumber === 0) {
                $showResult = 'Деление на ноль невозможно';
                $firstNumber = null;
                $secondNumber = null;
                $lastSign = null;
                $count = false;
            } elseif ($firstNumber != null) {
                $showResult = division($secondNumber, $firstNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        }
    } elseif ($count && $lastSign == '*') {
        echo 'второe умножение ' . $lastSign . '</br>';
        echo 'второe умножение ' . $firstNumber . '</br>';
        echo 'второe умножение ' . $secondNumber . '</br>';
        echo 'второe умножение ' . $showResult . '</br>';
        if (!(isset($_POST['multiply']))) {
            if (isset($_POST['plus'])) {
                echo 'второй умножение на плюс ' . $lastSign . '</br>';
                echo 'второй умножение на плюс ' . $firstNumber . '</br>';
                echo 'второй умножение на плюс ' . $secondNumber . '</br>';
                echo 'второй умножение на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['minus'])) {
                echo 'второй умножение на минус' . $lastSign . '</br>';
                echo 'второй умножение на минус ' . $firstNumber . '</br>';
                echo 'второй умножение на минус ' . $secondNumber . '</br>';
                echo 'второй умножение на минус ' . $showResult . '</br>';
                $lastSign = '-';
                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                echo 'второй умножение на деление ' . $lastSign . '</br>';
                echo 'второй умножение на деление ' . $firstNumber . '</br>';
                echo 'второй умножение на деление ' . $secondNumber . '</br>';
                echo 'второй умножение на деление ' . $showResult . '</br>';
                $lastSign = '/';

                $showResult = multiply($firstNumber, $secondNumber);
                $secondNumber = $showResult;
                $firstNumber = null;

            }
        }
    } else {
        $showResult = multiply($firstNumber, $secondNumber);
        $secondNumber = $showResult;
        $firstNumber = null;
    }
}
 */