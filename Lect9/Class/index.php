<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:13
 */

require_once __DIR__ . '/autoload.php';

/*$book = new \Classes\Book(1000,'Вдастелин колец', 'Толкиен');

echo $book->getCoast().'</br>';
echo $book->buy().'</br>';
echo $book->sell().'</br>';*/

$lordRingBookFactory = new \Classes\LordRingBookFactory();

$book2 = $lordRingBookFactory->create('Две башни','Толкиен',\Classes\LordKingBook::SPECIAL_EDITION);

echo $book2->getCoast().'</br>';
echo $book2->getDiscount().'</br>';
echo $book2->getCostWithDiscount($book2->getCoast()).'</br>';