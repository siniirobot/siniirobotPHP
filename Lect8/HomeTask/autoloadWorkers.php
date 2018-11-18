<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.2018
 * Time: 11:44
 */
var_dump(__DIR__);
spl_autoload_register(function ($className) {
    var_dump($className);
    var_dump(__DIR__ . '\Classes'. '\\'.$className);
    require_once __DIR__ . '\\' . $className . '.php';
});