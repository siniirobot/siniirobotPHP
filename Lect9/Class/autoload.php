<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 17.11.2018
 * Time: 7:22
 */

spl_autoload_register(function($className){
    require_once __DIR__ . '/' .$className . '.php';
});