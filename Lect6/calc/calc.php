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

if  (isset($_SESSION['login']) && isset($_SESSION['pass'])){
    $login = $_SESSION['login'];
    $pass = $_SESSION['pass'];
    if (auth($login,$pass)){
        $file = 'math.txt';
        $firstNumber = isset($_POST['firstNumber']) ? htmlspecialchars($_POST['firstNumber']) : null;
        $secondNumber = isset($_POST['secondNumber']) ? $_POST['secondNumber'] : null;
        $showResult = isset($showResult) ? ($showResult == null ? $firstNumber : 0) : ($firstNumber == null ? 0 : $firstNumber) ; // Выводит результат в поле ввода
        $count = isset($_POST['count']) ? $_POST['count'] : false;// Был ли нажат второй знак
        $lastSign = isset($_POST['lastSign']) ? $_POST['lastSign'] : null; // Последний знак который был нажат
        $equal = isset($_POST['lastEqual']) ? $_POST['lastEqual'] : false;// Была ли нажата кнопка равно
        $epsilon = 0.0000001;

        /**
         * Функция очистки всех переменных.
         */

        if (isset($_POST['clear'])) {
            $firstNumber = null;
            $secondNumber = null;
            $count = false;
            $lastSign = null;
            $showResult = 0;
            $equal = 0;
        }

        /**
         * Если мы хотим после вывода результата написать новое выражение то не обходимо что бы $equal было true
         */

        if ($equal && (isset($_POST['seven']) || isset($_POST['eight']) || isset($_POST['nine']) ||
                isset($_POST['six']) || isset($_POST['five']) || isset($_POST['four']) ||
                isset($_POST['three']) || isset($_POST['two']) || isset($_POST['one']))) {
            $secondNumber = null;
            $count = false;
            $lastSign = null;
            $showResult = null;
            $equal = false;
        }

        /**
         * Вывод чисел и точки
         */

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
        /**
         *Функция смены знака с положительного на отрицательный и наоборот.
         */

        if (isset($_POST['changeSign'])) {
            if ($firstNumber == null) {
                $secondNumber *= -1;
                $showResult = $secondNumber;
            } else {
                $firstNumber *= -1;
            }
        }

        /**
         *Функция смены знака с положительного на отрицательный и наоборот.
         */

        if ($lastSign != null && (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division']) || isset($_POST['multiply']))) {
            if ($firstNumber == null) {
                $showResult = $secondNumber;
            } else {
                $showResult = $firstNumber;
            }
            if ($count && $lastSign == '+') {
                if (!(isset($_POST['plus']))) {
                    // если последний нажатый знак не плюс , то выполняется функция plus и идет смена lastSign для последующей операции
                    if (isset($_POST['minus'])) {
                        $lastSign = '-';
                    } elseif (isset($_POST['division'])) {
                        $lastSign = '/';
                    } elseif (isset($_POST['multiply'])) {
                        $lastSign = '*';
                    }
                }
                $showResult = plus($firstNumber, $secondNumber);
                file_put_contents($file, $secondNumber . '+' . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif ($count && $lastSign == '-') {
                if (!(isset($_POST['minus']))) {
                    // если последний нажатый знак не минус , то выполняется функция minus и идет смена lastSign для последующей операции
                    if (isset($_POST['plus'])) {
                        $lastSign = '+';
                    } elseif (isset($_POST['division'])) {
                        $lastSign = '/';
                    } elseif (isset($_POST['multiply'])) {
                        $lastSign = '*';
                    }
                }
                $showResult = minus($secondNumber, $firstNumber);
                file_put_contents($file, $secondNumber . '-' . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif ($count && $lastSign == '/') {
                if (!isset($_POST['division'])) {
                    // если последний нажатый знак не деление, то выполняется функция division и идет смена lastSign для последующей операции
                    if (isset($_POST['plus'])) {
                        $lastSign = '+';
                    } elseif (isset($_POST['minus'])) {
                        $lastSign = '-';
                    } elseif (isset($_POST['multiply'])) {
                        $lastSign = '*';
                    }
                }
                if (abs($firstNumber) <= $epsilon) {
                    $showResult = 'Деление на ноль невозможно';
                    file_put_contents($file, $secondNumber . '/' . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
                    $firstNumber = null;
                    $secondNumber = null;
                    $lastSign = null;
                    $count = false;
                } elseif ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    file_put_contents($file, $secondNumber . '/' . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif ($count && $lastSign == '*') {
                if (!(isset($_POST['multiply']))) {
                    // если последний нажатый знак не умножение , то выполняется функция multiply и идет смена lastSign для последующей операции
                    if (isset($_POST['plus'])) {
                        $lastSign = '+';
                    } elseif (isset($_POST['minus'])) {
                        $lastSign = '-';
                    } elseif (isset($_POST['division'])) {
                        $lastSign = '/';
                    }
                }
                if ($firstNumber != null) {
                    $showResult = multiply($firstNumber, $secondNumber);
                    file_put_contents($file, $secondNumber . '*' . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            }
            $equal = false;
        }

        /**
         *При первом вводе знака, необходимо дождатся следуйщего числа и сохранить введеный знак для определения последующей операции.
         */

        if ($lastSign == null && (isset($_POST['plus']) || isset($_POST['minus'])
                || isset($_POST['division']) || isset($_POST['multiply']))) {
            $equal = false;
            if (isset($_POST['plus']) && !$count) {
                $lastSign = '+';
            } elseif (isset($_POST['minus']) && !$count) {
                $lastSign = '-';
            } elseif (isset($_POST['division']) && !$count) {
                $lastSign = '/';
            } elseif (isset($_POST['multiply']) && !$count) {
                $lastSign = '*';
            }
            $secondNumber = $firstNumber == null ? 0 : $firstNumber;
            $firstNumber = null;
            $count = true;
        }

        /**
         *Произведение операций при нажатии знака равно в зависимости от последнего нажатого знака.
         */

        if (isset($_POST['equally'])) {
            if ($equal) {
                $firstNumber = $equal;
            }
            switch ($lastSign) {
                case '+':
                    $showResult = plus($firstNumber, $secondNumber);
                    break;
                case '-':
                    $showResult = minus($secondNumber, $firstNumber);
                    break;
                case '/':
                    if (abs($firstNumber) <= $epsilon) {
                        $showResult = 'Деление на ноль невозможно';
                    } else {
                        $showResult = division($secondNumber, $firstNumber);
                    }
                    break;
                case '*':
                    $showResult = multiply($secondNumber, $firstNumber);
                    break;
            }
            file_put_contents($file, $secondNumber . $lastSign . ($firstNumber ? $firstNumber : 0) . '=' . $showResult . PHP_EOL, FILE_APPEND);
            if ($lastSign == '/' && abs($firstNumber) <= $epsilon) {
                $secondNumber = null;
                $lastSign = null;
                $count = false;
            } else {
                $secondNumber = $showResult;
            }
            if (abs($firstNumber) <= $epsilon) {
                $equal = $secondNumber;
            } else {
                $equal = $firstNumber;
            }
            $firstNumber = null;
        }

        /**
         *Разлогиниться
         */
        if (isset($_GET['logout']) > 0) {
            session_destroy();
            header('Location:auth.php');
            exit();
        }
    }else{
        session_destroy();
        header('Location:auth.php');
        exit();
    }
}else{
    session_destroy();
    header('Location:auth.php');
    exit();
}
?>
    <html>
    <head>
        <title>Личный кабинет</title>
        <style>
            * {
                position: relative
            }

            div [type = "submit"] {
                width: 40px;
                height: 40px;
                margin-top: 5px;
            }

            .right-button {
                position: absolute;
                right: 0;
            }

            .centre-right-button {
                position: absolute;
                right: 26%;
            }

            .centre-left-button {
                position: absolute;
                left: 26%;
            }
        </style>
    </head>
    <body>
    <div style="width: 190px;height: 310px">
        <form action="calc.php" method="post">
            <input type="hidden" name="lastEqual" value="<?= $equal; ?>">
            <input type="hidden" name="lastSign" value="<?= $lastSign; ?>">
            <input type="hidden" name="firstNumber" value="<?= $firstNumber; ?>">
            <input type="hidden" name="secondNumber" value="<?= $secondNumber; ?>">
            <input type="hidden" name="count" value="<?= $count; ?>">
            <input type="text" name="entryField" value="<?= $firstNumber; ?>" placeholder="<?= $showResult; ?>"
                   style="width: 100%;height: 30px"  >
            <br>
            <input type="submit" name="clear" value="C" style="width: 100%">
            <br>
            <input type="submit" name="seven" value="7">
            <input type="submit" name="eight" value="8" class="centre-left-button">
            <input type="submit" name="nine" value="9" class="centre-right-button">
            <input type="submit" name="division" value="/" class="right-button">
            <br>
            <input type="submit" name="four" value="4">
            <input type="submit" name="five" value="5" class="centre-left-button">
            <input type="submit" name="six" value="6" class="centre-right-button">
            <input type="submit" name="multiply" value="*" class="right-button">
            <br>
            <input type="submit" name="one" value="1">
            <input type="submit" name="two" value="2" class="centre-left-button">
            <input type="submit" name="three" value="3" class="centre-right-button">
            <input type="submit" name="minus" value="-" class="right-button">
            <br>
            <input type="submit" name="zero" value="0">
            <input type="submit" name="point" value="." class="centre-left-button">
            <input type="submit" name="plus" value="+" class="centre-right-button">
            <input type="submit" name="equally" value="=" class="right-button">
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
echo 'Начало ' . $lastSign . '</br>';
echo 'Начало ' . $firstNumber . '</br>';
echo 'Начало ' . $secondNumber . '</br>';
echo 'Начало ' . $showResult . '</br>';

/**
 *Функция смены знака с положительного на отрицательный и наоборот.
 */
/*
if (isset($_POST['changeSign'])) {
    if ($firstNumber == null) {
        $secondNumber *= -1;
    } else {
        $firstNumber *= -1;
    }
}

/**
 *Функция смены знака с положительного на отрицательный и наоборот.
 */
/*
if ($lastSign != null && (isset($_POST['plus']) || isset($_POST['minus']) || isset($_POST['division']) || isset($_POST['multiply']))) {
    $equal = false;
    if ($count && $lastSign == '+') {
        // операции над знаком плюс
        echo 'второй плюс ' . $lastSign . '</br>';
        echo 'второй плюс ' . $firstNumber . '</br>';
        echo 'второй плюс ' . $secondNumber . '</br>';
        echo 'второй плюс ' . $showResult . '</br>';
        if (!(isset($_POST['plus']))) {
            // если последний нажатый знак не плюс , то выполняется функция plus и идет смена lastSign для последующей операции
            if (isset($_POST['minus'])) {
                // операции с минусом при смене  с плюса на минус
                echo 'второй плюс на минус' . $lastSign . '</br>';
                echo 'второй плюс на минус ' . $firstNumber . '</br>';
                echo 'второй плюс на минус ' . $secondNumber . '</br>';
                echo 'второй плюс на минус ' . $showResult . '</br>';
                $lastSign = '-';
                $showResult = $showResult = plus($firstNumber, $secondNumber);
                file_put_contents($file,$secondNumber.'+'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                // операции с делением при смене с плюса на деление
                echo 'второй плюс на деление ' . $lastSign . '</br>';
                echo 'второй плюс на деление ' . $firstNumber . '</br>';
                echo 'второй плюс на деление ' . $secondNumber . '</br>';
                echo 'второй плюс на деление ' . $showResult . '</br>';
                $lastSign = '/';
                $showResult = plus($secondNumber, $firstNumber);
                file_put_contents($file,$secondNumber.'+'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;

            } elseif (isset($_POST['multiply'])) {
                // операции с умножением при смене  с плюса на умножение
                echo 'второй плюс на умножить' . $lastSign . '</br>';
                echo 'второй плюс на умножить ' . $firstNumber . '</br>';
                echo 'второй плюс на умножить ' . $secondNumber . '</br>';
                echo 'второй плюс на умножить ' . $showResult . '</br>';
                $lastSign = '*';
                $showResult = plus($firstNumber, $secondNumber);
                file_put_contents($file,$secondNumber.'+'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = plus($firstNumber, $secondNumber);
            file_put_contents($file,$secondNumber.'+'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
            $secondNumber = $showResult;
            $firstNumber = null;
        }

    } elseif ($count && $lastSign == '-') {
        // операции с минусом
        echo 'второй минус ' . $lastSign . '</br>';
        echo 'второй минус ' . $firstNumber . '</br>';
        echo 'второй минус ' . $secondNumber . '</br>';
        echo 'второй минус ' . $showResult . '</br>';
        if (!(isset($_POST['minus']))) {
            // если последний нажатый знак не минус , то выполняется функция minus и идет смена lastSign для последующей операции
            if (isset($_POST['plus'])) {
                // операции с плюсом при смене  с минуса на плюс
                echo 'второй минус на плюс ' . $lastSign . '</br>';
                echo 'второй минус на плюс ' . $firstNumber . '</br>';
                echo 'второй минус на плюс ' . $secondNumber . '</br>';
                echo 'второй минус на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                $showResult = minus($secondNumber, $firstNumber);
                file_put_contents($file,$secondNumber.'-'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            } elseif (isset($_POST['division'])) {
                // операции с делением при смене  с минуса на деление
                echo 'второй минус на деление ' . $lastSign . '</br>';
                echo 'второй минус на деление ' . $firstNumber . '</br>';
                echo 'второй минус на деление ' . $secondNumber . '</br>';
                echo 'второй минус на деление ' . $showResult . '</br>';
                $lastSign = '/';

                $showResult = minus($secondNumber, $firstNumber);
                file_put_contents($file,$secondNumber.'-'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;

            } elseif (isset($_POST['multiply'])) {
                // операции с умножением при смене  с минуса на умножение
                echo 'второй минус на умножить' . $lastSign . '</br>';
                echo 'второй минус на умножить ' . $firstNumber . '</br>';
                echo 'второй минус на умножить ' . $secondNumber . '</br>';
                echo 'второй минус на умножить ' . $showResult . '</br>';
                $lastSign = '*';
                $showResult = minus($secondNumber, $firstNumber);
                file_put_contents($file,$secondNumber.'-'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        } else {
            $showResult = minus($secondNumber, $firstNumber);
            file_put_contents($file,$secondNumber.'-'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
            $secondNumber = $showResult;
            $firstNumber = null;
        }
    } elseif ($count && $lastSign == '/') {
        // операции с делением
        echo 'второе деление ' . $lastSign . '</br>';
        echo 'второе деление ' . $firstNumber . '</br>';
        echo 'второе деление ' . $secondNumber . '</br>';
        echo 'второе деление ' . $showResult . '</br>';
        if (!isset($_POST['division'])) {
            // если последний нажатый знак не деление, то выполняется функция division и идет смена lastSign для последующей операции
            if (isset($_POST['plus'])) {
                // операции с плюсом при смене  с деления на плюс
                echo 'второй деление на плюс ' . $lastSign . '</br>';
                echo 'второй деление на плюс ' . $firstNumber . '</br>';
                echo 'второй деление на плюс ' . $secondNumber . '</br>';
                echo 'второй деление на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    file_put_contents($file,$secondNumber.'/'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['minus'])) {
                // операции с минусом при смене  с деления на минус
                echo 'второй деление на минус' . $lastSign . '</br>';
                echo 'второй деление на минус ' . $firstNumber . '</br>';
                echo 'второй деление на минус ' . $secondNumber . '</br>';
                echo 'второй деление на минус ' . $showResult . '</br>';
                $lastSign = '-';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    file_put_contents($file,$secondNumber.'/'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['multiply'])) {
                // операции с умножением при смене  с деления на умножение
                echo 'второй деление на умножить' . $lastSign . '</br>';
                echo 'второй деление на умножить ' . $firstNumber . '</br>';
                echo 'второй деление на умножить ' . $secondNumber . '</br>';
                echo 'второй деление на умножить ' . $showResult . '</br>';

                $lastSign = '*';
                if ($firstNumber != null) {
                    $showResult = division($secondNumber, $firstNumber);
                    file_put_contents($file,$secondNumber.'/'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            }
        } else {
            if ($firstNumber === 0) {
                $showResult = 'Деление на ноль невозможно';
                file_put_contents($file,$secondNumber.'/'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $firstNumber = null;
                $secondNumber = null;
                $lastSign = null;
                $count = false;
            } elseif ($firstNumber != null) {
                $showResult = division($secondNumber, $firstNumber);
                file_put_contents($file,$secondNumber.'/'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                $secondNumber = $showResult;
                $firstNumber = null;
            }
        }
    } elseif ($count && $lastSign == '*') {
        // операции с умножением
        echo 'второe умножение ' . $lastSign . '</br>';
        echo 'второe умножение ' . $firstNumber . '</br>';
        echo 'второe умножение ' . $secondNumber . '</br>';
        echo 'второe умножение ' . $showResult . '</br>';
        if (!(isset($_POST['multiply']))) {
            // если последний нажатый знак не умножение , то выполняется функция multiply и идет смена lastSign для последующей операции
            if (isset($_POST['plus'])) {
                // операции с плюсом при смене  с умножения на плюс
                echo 'второй умножение на плюс ' . $lastSign . '</br>';
                echo 'второй умножение на плюс ' . $firstNumber . '</br>';
                echo 'второй умножение на плюс ' . $secondNumber . '</br>';
                echo 'второй умножение на плюс ' . $showResult . '</br>';
                $lastSign = '+';
                if ($firstNumber != null) {
                    $showResult = multiply($firstNumber, $secondNumber);
                    file_put_contents($file,$secondNumber.'*'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['minus'])) {
                // операции с минусом при смене  с умножения на минус
                echo 'второй умножение на минус' . $lastSign . '</br>';
                echo 'второй умножение на минус ' . $firstNumber . '</br>';
                echo 'второй умножение на минус ' . $secondNumber . '</br>';
                echo 'второй умножение на минус ' . $showResult . '</br>';
                $lastSign = '-';
                if ($firstNumber != null) {
                    $showResult = multiply($firstNumber, $secondNumber);
                    file_put_contents($file,$secondNumber.'*'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            } elseif (isset($_POST['division'])) {
                // операции с делением при смене  с умножения на деление
                echo 'второй умножение на деление ' . $lastSign . '</br>';
                echo 'второй умножение на деление ' . $firstNumber . '</br>';
                echo 'второй умножение на деление ' . $secondNumber . '</br>';
                echo 'второй умножение на деление ' . $showResult . '</br>';
                $lastSign = '/';
                if ($firstNumber != null) {
                    $showResult = multiply($firstNumber, $secondNumber);
                    file_put_contents($file,$secondNumber.'*'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
                    $secondNumber = $showResult;
                    $firstNumber = null;
                }
            }
        }
    } else {
        $showResult = multiply($firstNumber, $secondNumber);
        file_put_contents($file,$secondNumber.'*'.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
        $secondNumber = $showResult;
        $firstNumber = null;
    }
}

/**
 *При первом вводе знака, необходимо дождатся следуйщего числа и сохранить введеный знак для определения последующей операции.
 */
/*
if ($lastSign == null && (isset($_POST['plus']) || isset($_POST['minus'])
        || isset($_POST['division']) || isset($_POST['multiply']))) {
    $equal = false;
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
}

/**
 *Произведение операций при нажатии знака равно в зависимости от последнего нажатого знака.
 */
/*
if (isset($_POST['equally']) && $secondNumber) {
    if ($lastSign == '+') {
        echo 'Равно плюс ' . $lastSign . '</br>';
        echo 'Равно плюс ' . $firstNumber . '</br>';
        echo 'Равно плюс ' . $secondNumber . '</br>';
        echo 'Равно плюс ' . $showResult . '</br>';
        $showResult = plus($firstNumber, $secondNumber);
        file_put_contents($file,$secondNumber.$lastSign.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
        $secondNumber = $showResult;
        $firstNumber = null;

    } elseif ($lastSign == '-') {
        echo 'Равно минус ' . $lastSign . '</br>';
        echo 'Равно минус ' . $firstNumber . '</br>';
        echo 'Равно минус ' . $secondNumber . '</br>';
        echo 'Равно минус ' . $showResult . '</br>';
        $showResult = minus($secondNumber, $firstNumber);
        file_put_contents($file,$secondNumber.$lastSign.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
        $secondNumber = $showResult;
        $firstNumber = null;
    } elseif ($lastSign == '/') {
        echo 'Равно деление ' . $lastSign . '</br>';
        echo 'Равно деление ' . $firstNumber . '</br>';
        echo 'Равно деление ' . $secondNumber . '</br>';
        echo 'Равно деление ' . $showResult . '</br>';
        if ($firstNumber == 0) {
            $showResult = 'Деление на ноль невозможно';
            file_put_contents($file,$secondNumber.$lastSign.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
            $firstNumber = null;
            $secondNumber = null;
            $lastSign = null;
            $count = false;
        } else {
            $showResult = division($secondNumber, $firstNumber);
            file_put_contents($file,$secondNumber.$lastSign.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
            $secondNumber = $showResult;
            $firstNumber = null;
        }
    } elseif ($lastSign == '*') {
        echo 'Равно умножить ' . $lastSign . '</br>';
        echo 'Равно умножить  ' . $firstNumber . '</br>';
        echo 'Равно умножить  ' . $secondNumber . '</br>';
        echo 'Равно умножить  ' . $showResult . '</br>';
        $showResult = multiply($secondNumber, $firstNumber);
        file_put_contents($file,$secondNumber.$lastSign.($firstNumber ? $firstNumber : 0).'='.$showResult.PHP_EOL,FILE_APPEND);
        $secondNumber = $showResult;
        $firstNumber = null;
    }
    $equal = true;
}
 */