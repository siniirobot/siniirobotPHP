<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 25.01.2019
 * Time: 15:05
 */

namespace Validation;


class PasswordHash
{
    public static function hash($password)
    {
        return password_hash($password, PASSWORD_DEFAULT, ['cost' => 14]);
    }

    public static function verify($password, $hash)
    {
        return password_verify($password, $hash);
    }
}