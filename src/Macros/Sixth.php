<?php

namespace Spatie\CollectionMacros\Macros;

class Sixth
{
    public function __invoke()
    {
        return function () {
            return $this->skip(5)->first();
        };
    }
}
