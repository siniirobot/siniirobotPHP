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

function plus($data) {
    $summ = 0;
    foreach ($data as $value) {
        $summ += $value;
    }
    return $summ;
}