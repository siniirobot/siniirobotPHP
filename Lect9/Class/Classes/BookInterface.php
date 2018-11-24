<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:20
 */

namespace Classes;


interface BookInterface
{
    const PUBLISHING_HOUSE = 'Дрофа';
    public function setAuthor(string $author);
    public function getAuthor():string ;
    public function setPagesCount(int $pagesCount) ;
    public function getPagesCount():int ;

}

interface GoodInterface
{
    public function getSomeThing();
}

interface BaseInterface extends BookInterface2,GoodInterface
{

}