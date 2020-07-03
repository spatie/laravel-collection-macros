<?php

namespace Spatie\CollectionMacros\Macros;

class Fifth
{
    public function __invoke()
    {
        return function () {
            return $this->skip(4)->first();
        };
    }
}
