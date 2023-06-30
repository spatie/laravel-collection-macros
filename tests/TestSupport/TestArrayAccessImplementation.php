<?php

namespace Spatie\CollectionMacros\Test\TestSupport;

use ArrayAccess;

class TestArrayAccessImplementation implements ArrayAccess
{
    private $arr;

    public function __construct($arr)
    {
        $this->arr = $arr;
    }

    public function offsetExists($offset): bool
    {
        return isset($this->arr[$offset]);
    }

    public function offsetGet($offset): mixed
    {
        return $this->arr[$offset];
    }

    public function offsetSet($offset, $value): void
    {
        $this->arr[$offset] = $value;
    }

    public function offsetUnset($offset): void
    {
        unset($this->arr[$offset]);
    }
}
