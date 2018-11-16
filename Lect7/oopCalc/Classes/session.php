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
        $_SESSION['session'] = array(
            'login' => $login,
            'pass' => $pass,
            );
    }

    public function get($login){
        session_start();
        return $_SESSION['session'][$login];
    }

    public function destroy() {
        session_destroy();
        header('Location: Lect7/oopCalc/auth.php');
        exit();
    }


}