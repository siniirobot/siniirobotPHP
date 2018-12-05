<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 12:04
 */

namespace Classes;


class BookCacheDecorator
{
    protected $book;
    protected $cache;

    public function __construct(BookInterface2 $book, CacheInterface $cache)
    {
        $this->book = $book;
        $this->cache = $cache;
    }

    /**
     * Вернуть содержимое кэша по ключу и если нету, то создать его а затем вернуть.
     * @param string $id
     * @return string
     */
    public function getBook(string $id): string
    {
        if ($this->cache->checkByKey($id)) {
            return $this->cache->getByKey($id);
        }
        $this->cache->setByKey($this->book->getAuthor(), $this->book->getContent());
        return $this->cache->getByKey($id);
    }
}