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
        $session = new session();
        if ($this->check($login, $pass)) {
            require_once __DIR__ . '/Session.php';
            $session->set($login, $pass);
            header('Location: /Lect7/oopCalc/Calculator.php');
            exit();
        } else {
            echo 'Введите верные даные';
            $session->destroy();
        }
    }

    public function logout()
    {
        require_once __DIR__ . '/Session.php';
        $session = new session();
        $session->destroy();
    }
}