<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 11:53
 */

namespace Classes;


interface CacheInterface
{
    /**
     * Получить по ключу.
     * @return string
     */
    public function getByKey(string $key): string ;

    /**
     * Установить по ключу.
     * @param string $key
     * @return mixed
     */
    public function setByKey(string $key, $value) ;

    /**
     * Проверить есть ли.
     * @param string $key
     * @return bool
     */
    public function checkByKey(string $key) : bool ;
}