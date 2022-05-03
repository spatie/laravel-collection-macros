<?php

namespace Spatie\CollectionMacros\Macros;

class TwentyFirst
{
    public function __invoke()
    {
        return function () {
            return $this->skip(20)->first();
        };
    }
}
