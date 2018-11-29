<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 12:27
 */

header('Content-Type: text/html; charset=utf-8');
error_reporting(E_ALL);

require_once __DIR__ . '/autoload.php';

use Classes\Product;
use Classes\Book2;
use Classes\TestCache;
use Classes\BookCacheDecorator;

$product = new Product('Гарри Поттер',500);

echo $product->getCost().'</br>';
echo $product->getName().'</br>';

$book = new Book2($product->getName(),$product->getCost(),'Д.Роулинг',3940,'Дрофа');
$book->setContent('./ГарриПоттер.txt');
echo $book->getAuthor().'</br>';
echo $book->getPageCount().'</br>';
echo $book->getPublisher().'</br>';

$cache = new TestCache();

$bookCache = new BookCacheDecorator($book,$cache);
echo $bookCache->getBook('Д.Роулинг').'</br>';

$book2 = new Book2('Властелин Колец', 1500,'Толкиен', 3000,'Эпилог');
$book2->setContent('./Властелин Колец.txt');
echo $bookCache->setBook($book2).'</br>';
echo $bookCache->getBook('Толкиен').'</br>';
print_r($bookCache);