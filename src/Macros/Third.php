<?php

namespace Spatie\CollectionMacros\Macros;

class Third
{
    public function __invoke()
    {
        return function () {
            return $this->skip(2)->first();
        };
    }
}
