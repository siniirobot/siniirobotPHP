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

    public function getByKey(string $key): string
    {
        if (array_key_exists($key,$this->cache)){
            return $this->cache[$key];
        }else{
            return null;
        }
    }

    public function setByKey(string $key, $value)
    {
        $this->cache = [$key => $value];
    }

    public function checkByKey(string $key): bool
    {
        if (array_key_exists($key,$this->cache)){
            return true;
        }else{
            return false;
        }
    }


}