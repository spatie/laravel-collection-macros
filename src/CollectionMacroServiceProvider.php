<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;
use Spatie\CollectionMacros\MacroClasses\AtMacro;
use Spatie\CollectionMacros\MacroClasses\AfterMacro;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make(glob(__DIR__.'/macros/*.php'))
            ->mapWithKeys(function ($path) {
                return [$path => pathinfo($path, PATHINFO_FILENAME)];
            })
            ->reject(function ($macro) {
                return Collection::hasMacro($macro);
            })
            ->each(function ($macro, $path) {
                require_once $path;
            });

        /*
         * Research
         */
        Collection::mixin(new AtMacro());
        Collection::mixin(new AfterMacro());
    }
}
