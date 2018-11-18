<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 16.11.2018
 * Time: 9:50
 */

class User
{
    public function check($login, $pass)
    {
        $loginTrue = 'admin';
        $passTrue = '11';
        if ($login == $loginTrue && $pass == $passTrue) {
            return true;
        } else {
            return false;
        }
    }

    public function login($login, $pass)
    {
        require_once __DIR__ . '/Session.php';
        $session = new session();
        $session->set($login, $pass);
        header('Location: /Lect7/oopCalc/Calculator.php');
        exit();
    }

    public function logout()
    {
        require_once __DIR__ . '/Session.php';
        $session = new session();
        $session->destroy();
    }
}