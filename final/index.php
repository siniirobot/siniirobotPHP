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
use Validation\ValidationAuth;

$proba_find = new ActiveRecordAuth();
$proba_find = $proba_find->find('Ilchenko@mail.com');
echo 'Id:'.$proba_find->id .'</br>Login:'.$proba_find->login . '</br>Pass:' . $proba_find->pass . '</br>';
$proba_find->pass = 'PasterMaster';
$proba_find->update();

$proba_pera = new ActiveRecordAuth();
$proba_pera->delete();
$proba_pera->login = 'Mironov@mail.com';
$proba_pera->pass = 'PassMassFax';
$proba_pera->create();

$proba_read = new ActiveRecordAuth();
$proba_read->read();
echo 'Id:'.$proba_read->id .'</br>Login:'.$proba_read->login . '</br>Pass:' . $proba_read->pass . '</br>';
$proba_read->pass = 'MasterPass';
$proba_read->update();
echo 'Id:'.$proba_read->id .'</br>Login:'.$proba_read->login . '</br>Pass:' . $proba_read->pass . '</br>';


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
