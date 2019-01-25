<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 15.01.2019
 * Time: 10:55
 */

require_once __DIR__.'/autoload.php';

use Databases\ActiveRecordAuth;
use Databases\DBAuth;
use Validation\Validation;


$proba_pera = new ActiveRecordAuth();
$proba_pera->delete();
$proba_pera->login = 'Ilchenko@mail.com';
$proba_pera->pass = 'Pass';
$proba_pera->create();


?>


<head>
    <title>Ветеренарная клиника</title>
    <link href="css/CSSReset.css" rel="stylesheet">
    <link href="css/CSS.css" rel="stylesheet">
</head>
<body>
    <div class="login_form">
        <form action="index.php" method="post">
            <input type="text" name="login" placeholder="Введите свой логин.">
            </br>
            <input type="password" name="password" placeholder="Введите свой пароль.">
            </br>
            <input type="submit" name="Ok" value="Войти">
            </br>
            <a>Не могу войти</a>
            </br>
            <a>Регистрация</a>
            </br>
        </form>
    </div>
</body>
