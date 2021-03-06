<?php

namespace six\orm;

use six\exception\SixEntityException;

/**
 * 实体。
 * 
 */
abstract class SixEntity
{
    public function __get($name)
    {
        if (property_exists($this, $name)) {
            return $this->$name;
        }
        throw new SixEntityException();
    }

    public static function create()
    {
    }

    public static function drop()
    {
    }
}
