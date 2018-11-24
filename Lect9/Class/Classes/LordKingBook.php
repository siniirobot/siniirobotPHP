<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:18
 */

namespace Classes;


class LordKingBook extends Book
{
    final public function setCoast($coast): void
    {
        parent::setCoast($coast);
    }

     const SPECIAL_EDITION = 'special';
     const SPECIAL_EDITION_PRICE = 1100;

     const REGULAR_EDITION = 'regular';
     const REGULAR_EDITION_PRICE = 900;
}