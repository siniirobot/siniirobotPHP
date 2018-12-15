<?php
/**
 * Created by PhpStorm.
 * User: sinii
 * Date: 24.11.2018
 * Time: 11:56
 */

namespace Classes;


class TestCache implements CacheInterface
{
    private $cache = [];

    /**
     * Извлечь содержимое по ключу.
     * @param string $key
     * @return string
     */
    public function getByKey(string $key): string
    {
        if (array_key_exists($key, $this->cache)) {
            return $this->cache[$key];
        } else {
            return 'Такой книги с таким ключем нет ';
        }
    }

    /**
     * Установить содержимое по ключу.
     * @param string $key
     * @param $value
     * @return mixed|void
     */
    public function setByKey(string $key, $value)
    {
        $this->cache = [$key => $value];
    }

    /**
     * Проверить содержимое по ключу.
     * @param string $key
     * @return bool
     */
    public function checkByKey(string $key): bool
    {
        if (array_key_exists($key, $this->cache)) {
            return true;
        } else {
            return false;
        }
    }


}