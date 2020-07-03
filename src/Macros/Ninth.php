<?php

namespace Spatie\CollectionMacros\Macros;

class Ninth
{
    public function __invoke()
    {
        return function () {
            return $this->skip(8)->first();
        };
    }
}
