<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 31.10.2018
 * Time: 20:34
 */

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