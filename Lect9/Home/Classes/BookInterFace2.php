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
     * Устанавливает содержимое книги
     * @param $file
     * @return mixed
     */
    public function setContent(string $file);

    /**
     * Возвращает содержимое книги.
     * @return string
     */
    public function getContent(): string;

    /**
     * Вернуть автора.
     * @return string
     */
    public function getAuthor(): string;

    /**
     * Вернуть колличесвто страниц.
     * @return int
     */
    public function getPageCount(): int;

    /**
     * Вернуть издателя.
     * @return string
     */
    public function getPublisher(): string;

    public function getTome(): string;
}