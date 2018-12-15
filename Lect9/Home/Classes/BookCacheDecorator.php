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
     * @return array
     */
    public function getBook(string $id): array
    {

        if (!$this->cache->checkByKey($id)) {
            $this->cache->setByKey($id, $this->book->getContent());
            return [$this->cache->getByKey($id)];
        }
        return [$this->cache->getByKey($id).'from cache'];
    }
}