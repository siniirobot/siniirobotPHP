<?php

function auth($login, $pass) {

    $trueLogin = 'admin';
    $truePass = 'admin';

    if ($login == $trueLogin && $pass == $truePass) {
        $_SESSION['login'] = $login;
        $_SESSION['pass'] = $pass;
        return true;
    };
    return false;
}

function plus($firstNumber,$secondNumber) {
    return $firstNumber + $secondNumber;
}

function minus($firstNumber,$secondNumber) {
    return $firstNumber - $secondNumber;
}

function multiply($firstNumber,$secondNumber) {
    return $firstNumber * $secondNumber;
}

function division($firstNumber,$secondNumber) {
    return $firstNumber / $secondNumber;
}

