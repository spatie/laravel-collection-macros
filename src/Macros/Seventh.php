<?php

namespace Spatie\CollectionMacros\Macros;

class Seventh
{
    public function __invoke()
    {
        return function () {
            return $this->skip(6)->first();
        };
    }
}
