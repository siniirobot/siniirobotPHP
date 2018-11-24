<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:04
 */

namespace Classes;
abstract class Good
{
     protected $coast;

    abstract public function sell() : string;

    abstract public function buy() : string;

    public function __construct($coast)
    {
        $this->coast = $coast;
    }

    /**
     * @return mixed
     */
    public function getCoast()
    {
        return $this->coast;
    }

    /**
     * @param mixed $coast
     */
    public function setCoast($coast): void
    {
        $this->coast = $coast;
    }


}