<?php

function registration(){
    require_once '/study/OSPanel/domains/first/final/Databases/DBAuth.php';
    $query = DBAuth::pdo()->query('SELECT * FROM auth');
    var_dump($query->fetch(PDO::FETCH_ASSOC));
    $query = DBAuth::pdo()->prepare('INSERT INTO auth (login,pass) VALUES(?,?)');
    $query->execute(['Login','Pass']);
    $query = DBAuth::pdo()->query('SELECT * FROM auth');
    var_dump($query->fetchAll(PDO::FETCH_ASSOC));
}
