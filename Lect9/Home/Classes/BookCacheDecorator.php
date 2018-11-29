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

    /**
     * Вернуть содержимое кэша по ключу и если нету, то создать его а затем вернуть.
     * @param string $id
     * @return string
     */
    public function getBook(string $id) : string
    {
        if ($this->cache->checkByKey($id)){
            return $this->cache->getByKey($id);
        }
         $this->cache->setByKey($this->book->getAuthor(),$this->book->getContent());
        return $this->cache->getByKey($id);
    }

    /**
     * Добавить в кэш новую книгу.
     * @param BookInterface2 $book
     * @return string
     */
    public function setBook(BookInterface2 $book) : string
    {
        if ($this->cache->checkByKey($book->getAuthor())){
            return 'Такая книга уже есть';
        }
        $this->cache->setByKey($book->getAuthor(),$book->getContent());
        return 'Книга добавлена в кэш';
    }

    public function delBook(BookInterface2 $book)
    {
        if ($this->cache->checkByKey($book->getAuthor())) {
            print_r($this->cache);
            $this->cache[$book->getAuthor()] = null;
            echo 'Книга удалена'.'</br>';
        }else{
            echo 'Такой книги нет'.'</br>';
        }

    }
}