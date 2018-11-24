<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:09
 */

namespace Classes;
class Book extends Product implements BookInterface2
{
    use DiscountTrait{
        DiscountTrait::getDiscount as public;
        DiscountTrait::Test as public;
    }

    function Test(): int
    {
        return 100;
    }

    protected $name;
    protected $author;
    protected $pagesCount;

    public function __construct($coast, $name, $author)
    {
        parent::__construct($coast);
        $this->name = $name;
        $this->author = $author;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name): void
    {
        $this->name = $name;
    }

    public function sell(): string
    {
        return'Book was sold';
    }

    public function buy(): string
    {
        return'Book was bought';
    }

    public function setPagesCount(int $pagesCount)
    {
        $this->pagesCount = $pagesCount;
    }

    public function getPagesCount(): int
    {
        return $this->pagesCount;
    }

    public function getAuthor(): string
    {
        return $this->author;
    }

    public function setAuthor(string $author)
    {
        $this->author = $author;
    }


}