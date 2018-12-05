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

$product = new Product('Гарри Поттер и филосовский камень.', 500);

echo $product->getCost() . '</br>';
echo $product->getName() . '</br>';

$book = new Book2($product->getName(), $product->getCost(), 'Д.Роулинг', 3940, 'Дрофа', 1, 8);
$book->setContent('./ГарриПоттер.txt');
echo $book->getAuthor() . '</br>';
echo $book->getPageCount() . '</br>';
echo $book->getPublisher() . '</br>';
echo $book->getTome() . '</br>';

$cache = new TestCache();

$bookCache = new BookCacheDecorator($book, $cache);


$book2 = new Book2('Две Башни', 1500, 'Толкиен', 3000, 'Эпилог', 2, 3);
$book2->setContent('./Властелин Колец.txt');

echo $bookCache->getBook('Толкиен') . '</br>';

echo $bookCache->getBook('Д.Роулинг') . '</br>';
echo $book2->getTome() . '</br>';


