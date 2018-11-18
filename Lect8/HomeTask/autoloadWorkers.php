<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 18.11.2018
 * Time: 11:44
 */

spl_autoload_register(function($className){
    require_once __DIR__ . '/' .$className . '.php';
});