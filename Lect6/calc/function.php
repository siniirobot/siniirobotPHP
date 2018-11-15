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

function addition($firstNumber, $secondNumber) {
    return $firstNumber + $secondNumber;
}

function subtraction($firstNumber, $secondNumber) {
    return $firstNumber - $secondNumber;
}

function multiplication($firstNumber, $secondNumber) {
    return $firstNumber * $secondNumber;
}

function division($firstNumber,$secondNumber) {
    return $firstNumber / $secondNumber;
}

