<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 15.11.2018
 * Time: 15:22
 */

class session
{

    public function set($login,$pass){
        $_SESSION = array(
            'login' => $login,
            'pass' => $pass,
            );
    }

    public function get($key){
        return $_SESSION[$key];
    }

    public function destroy() {
        session_destroy();
        header('Location: /Lect7/oopCalc/Auth.php');
        exit();
    }

}