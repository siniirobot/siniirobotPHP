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

if (isset($_SESSION['login']) && isset($_SESSION['pass'])) {
    $login = $_SESSION['login'];
    $pass = $_SESSION['pass'];
    if (auth($login, $pass)) {
        $file = 'math.txt';
        $firstNumber = isset($_POST['firstNumber']) ? htmlspecialchars($_POST['firstNumber']) : null;
        $secondNumber = isset($_POST['secondNumber']) ? $_POST['secondNumber'] : null;
        $showResult = isset($showResult) ? ($showResult == null ? $firstNumber : 0) : ($firstNumber == null ? 0 : $firstNumber); // Выводит результат в поле ввода
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
                $showResult = addition($firstNumber, $secondNumber);
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
                $showResult = subtraction($secondNumber, $firstNumber);
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
                    $showResult = multiplication($firstNumber, $secondNumber);
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
                    $showResult = addition($firstNumber, $secondNumber);
                    break;
                case '-':
                    $showResult = subtraction($secondNumber, $firstNumber);
                    break;
                case '/':
                    if (abs($firstNumber) <= $epsilon) {
                        $showResult = 'Деление на ноль невозможно';
                    } else {
                        $showResult = division($secondNumber, $firstNumber);
                    }
                    break;
                case '*':
                    $showResult = multiplication($secondNumber, $firstNumber);
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
    } else {
        session_destroy();
        header('Location:auth.php');
        exit();
    }
} else {
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
                   style="width: 100%;height: 30px">
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