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
    protected $publisher;
    protected $file;
    protected $numberTome;
    protected $tomeCount;

    public function __construct(string $name, int $cost, string $author, int $pageCount, string $publisher, int $numberTome, int $tomeCount)
    {
        parent::__construct($name, $cost);
        $this->author = $author;
        $this->pageCount = $pageCount;
        $this->publisher = $publisher;
        $this->numberTome = $numberTome;
        $this->tomeCount = $tomeCount;
    }

    /**
     * @return mixed
     */
    public function getNumberTome()
    {
        return $this->numberTome;
    }

    /**
     * @param mixed $numberTome
     */
    public function setNumberTome($numberTome): void
    {
        $this->numberTome = $numberTome;
    }

    /**
     * @return mixed
     */
    public function getTomeCount()
    {
        return $this->tomeCount;
    }

    /**
     * @param mixed $tomeCount
     */
    public function setTomeCount($tomeCount): void
    {
        $this->tomeCount = $tomeCount;
    }

    /**
     * Вернуть издателя
     * @return string
     */
    public function getPublisher(): string
    {
        return $this->publisher;
    }

    /**
     * Установить издателя
     * @param string $publisher
     */
    public function setPublisher(string $publisher)
    {
        $this->publisher = $publisher;
    }


    /**
     * Устанавливает содержимое книги
     * @param $file
     * @return mixed|void
     */
    public function setContent($file)
    {
        $this->file = $file;
    }

    /**
     * Возвращает содержимое книги.
     * @return string
     */
    public function getContent(): string
    {
        return file_get_contents($this->file);
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

    public function getTome(): string
    {
        return 'Это ' . $this->numberTome . ' том из ' . $this->tomeCount;
    }
}