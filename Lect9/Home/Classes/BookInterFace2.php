<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 11:35
 */

namespace Classes;


interface BookInterface2
{
    /**
     * Судя по всему должно вернуть содержимое книги.
     * @return string
     */
    public function getContent() : string;

    /**
     * Вернуть автора.
     * @return string
     */
    public function getAuthor() : string;

    /**
     * Вернуть колличесвто страниц.
     * @return int
     */
    public function getPageCount() : int;

}