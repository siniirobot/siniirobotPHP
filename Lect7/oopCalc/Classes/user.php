<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 16.11.2018
 * Time: 9:50
 */

class user
{
    private $login;
    private $pass;

    public function __construct($login, $pass)
    {
        $this->login = $login;
        $this->pass = $pass;
    }

    /**
     * @return mixed
     */
    public function getLogin()
    {
        return $this->login;
    }

    /**
     * @param mixed $login
     */
    public function setLogin($login)
    {
        $this->login = $login;
    }

    /**
     * @return mixed
     */
    public function getPass()
    {
        return $this->pass;
    }

    /**
     * @param mixed $pass
     */
    public function setPass($pass)
    {
        $this->pass = $pass;
    }

    public function check($login, $pass)
    {
        if ($login == $this->login && $pass == $this->pass) {
            return true;
        } else {
            return false;
        }
    }

    public function login($login, $pass)
    {
        if ($this->check($login, $pass)) {
            require_once __DIR__ . '/session.php';
            session_start();
            $session = new session();
            $session->set($login, $pass);
            header('Location: Lect7/oopCalc/calculator.php');
            exit();
        } else {
            echo 'Введите верные даные';
        }
    }

    public function logout()
    {
        require_once __DIR__ . '/session.php';
        $session = new session();
        $session->destroy();
    }
}