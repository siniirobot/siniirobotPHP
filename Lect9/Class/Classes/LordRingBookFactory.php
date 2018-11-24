<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 10:34
 */

namespace Classes;


class LordRingBookFactory
{

    public function create($name,$author,$edition) : BookInterface
    {
        if (LordKingBook::SPECIAL_EDITION === $edition){
            return new LordKingBook(LordKingBook::SPECIAL_EDITION_PRICE,$name,$author);
        }
        return new LordKingBook(LordKingBook::REGULAR_EDITION_PRICE,$name,$author);
    }
}