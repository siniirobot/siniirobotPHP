<?php
/**
 * Created by PhpStorm.
 * User: HEAD
 * Date: 25.10.2018
 * Time: 10:56
 */

//1-----------------------------

/**
����� �� $a == $b? ����� �� $b == $c? ����� �� $a == $c?
<?php
$a = 0;
$b = null;
$c = �0�;*/
//1) �� ��� ���, ��� �������� ��������� �� ����� ���� �������� �����.
//2) ���, ��� ��� ��� ������ ������� �� �������� 0 � ��� �� �������� ������.
//3) �� ��� ���, ��� �������� ��������� �� ����� ���� �������� �����.

//2------------------------------
/**
���� ����� ����� $a?
$a = �1�;
$a[$a] = ��2�;
echo $a;

 */
// ����� ����� 12

//3-----------------------------
/**
�����? ����� ��������� ���������� ����� �������?
<?php
$a = 10;
$b = 4;
echo (int)$a / (int)$b;

 */
//2.5 ��� ��� ����� ��������� ���� ��������� � ���������� ���������� � �� � ��������� � �����.

//4--------------------------------
/**
�����? ����� ��������� ���������� ����� �������?
<?php
$arr = array(1,2,3,4,5,6,7,8,9);
$count = count($arr);
if ($count = 0) {
echo �Array is empty.�;
} else {
echo �Array contains $count elements.�;
}

 */
//Array contains 0 elements. ��� ��� $count = 0 ��� false;