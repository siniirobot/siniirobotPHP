<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 11:32
 */

spl_autoload_register(function($className){
    var_dump(__DIR__);
    require_once __DIR__ . '/' .$className . '.php';
});