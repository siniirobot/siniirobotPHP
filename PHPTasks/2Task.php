<?php
/**
 * Created by PhpStorm.
 * User: user
 * Date: 15.10.2018
 * Time: 18:16
 */

error_reporting(E_ALL);
//1--------------------------------------

const FIRST_CONSTANT=42;

//2-------------------------------------

if(FIRST_CONSTANT){
    echo "���������� ���������� firstConstant</br>".PHP_EOL;
}else{
    echo "�� ���������� ���������� firstConstant</br>".PHP_EOL;
}

//3---------------------------------------

echo '�������� ���� ��������� ����� = '.FIRST_CONSTANT.'.</br>'.PHP_EOL;

//4---------------------------------------

//FIRST_CONSTANT = 35;
//������ ������ Expression is not assignable: Constant reference