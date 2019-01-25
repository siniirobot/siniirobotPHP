<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 25.01.2019
 * Time: 15:13
 */

namespace Registration;

use Databases\ActiveRecordAuth;

class Registration
{
    public function Registration($login, $password) {
        $user = new ActiveRecordAuth();
        $user->login = $login;
        $user->pass = $password;
        if ($user->create()){
            return true;
        }

        return false;
    }
}