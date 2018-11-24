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

    public function __construct (BookInterface2 $book ,CacheInterface $cache)
    {
        $this->book = $book;
        $this->cache = $cache;
    }

    public function getBook(string $id) : string
    {
        if ($this->cache->checkByKey($id)){
            return $this->cache->getByKey($id);
        }
        return $this->cache->setByKey($this->book->getName(),$this->book->getContent());
    }
}