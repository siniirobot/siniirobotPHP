<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 11:40
 */

namespace Classes;


class Book2 extends Product implements BookInterface2
{
    protected $author;
    protected $pageCount;

    public function __construct(string $name, int $cost, string $author, int $pageCount)
    {
        parent::__construct($name, $cost);
        $this->author = $author;
        $this->pageCount = $pageCount;
    }

    /**
     * Судя по всему должно вернуть содержимое книги.
     * @return string
     */
    public function getContent(): string
    {
        return file_get_contents(__DIR__ . '../ГарриПоттер.txt');
    }

    /**
     * Вернуть автора.
     * @return string
     */
    public function getAuthor(): string
    {
        return $this->author;
    }

    /**
     * Вернуть колличесвто страниц.
     * @return int
     */
    public function getPageCount(): int
    {
        return $this->pageCount;
    }

    /**
     * @param string $author
     */
    public function setAuthor(string $author): void
    {
        $this->author = $author;
    }

    /**
     * @param int $pageCount
     */
    public function setPageCount(int $pageCount): void
    {
        $this->pageCount = $pageCount;
    }



}