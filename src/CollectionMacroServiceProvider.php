<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        foreach (glob(__DIR__.'/macros/*.php') as $path) {
            $macro = pathinfo($path, PATHINFO_FILENAME);

            if (! Collection::hasMacro($macro)) {
                require_once $path;
            }
        }
    }
}
