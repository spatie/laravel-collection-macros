<?php

namespace Spatie\CollectionMacros\Macros;

class Second
{
    public function __invoke()
    {
        return function () {
            return $this->skip(1)->first();
        };
    }
}
