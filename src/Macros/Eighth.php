<?php

namespace Spatie\CollectionMacros\Macros;

class Eighth
{
    public function __invoke()
    {
        return function () {
            return $this->skip(7)->first();
        };
    }
}
