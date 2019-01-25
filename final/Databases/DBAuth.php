<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 08.12.2018
 * Time: 11:40
 */

namespace Databases;

use \PDO;
use \PDOException;
final class DBAuth
{
    protected static $_pdo = null;

    private static $dbhost = '127.0.0.1:3307';
    private static $dbName = 'auth';
    private static $dbUser = 'root';
    private static $pdPass = '';

    protected function __construct()
    {
        echo 'Конструктор запущен';
    }

    protected function __clone()
    {
        // TODO: Implement __clone() method.
    }

    protected function __wakeup()
    {
        // TODO: Implement __wakeup() method.
    }

    public static function pdo()
    {
        if (is_null(self::$_pdo)){
            try{

                self::$_pdo = new PDO(
                    'mysql:host=' . self::$dbhost . ';dbname=' . self::$dbName,self::$dbUser,self::$pdPass
                );
            }catch (PDOException $e){
                echo 'Подключение не удалось ' . $e->getMessage();
            }

        }
       return self::$_pdo;
    }
}

