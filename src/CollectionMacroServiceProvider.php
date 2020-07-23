<?php

namespace Spatie\CollectionMacros;

use Illuminate\Support\Collection;
use Illuminate\Support\ServiceProvider;

class CollectionMacroServiceProvider extends ServiceProvider
{
    public function register()
    {
        Collection::make($this->macros())
            ->reject(fn ($class, $macro) => Collection::hasMacro($macro))
            ->each(fn ($class, $macro) => Collection::macro($macro, app($class)()));
    }

    private function macros(): array
    {
        return [
            'accumulate' => \Spatie\CollectionMacros\Macros\Accumulate::class,
            'after' => \Spatie\CollectionMacros\Macros\After::class,
            'at' => \Spatie\CollectionMacros\Macros\At::class,
            'before' => \Spatie\CollectionMacros\Macros\Before::class,
            'chunkBy' => \Spatie\CollectionMacros\Macros\ChunkBy::class,
            'collectBy' => \Spatie\CollectionMacros\Macros\CollectBy::class,
            'eachCons' => \Spatie\CollectionMacros\Macros\EachCons::class,
            'eighth' => \Spatie\CollectionMacros\Macros\Eighth::class,
            'extract' => \Spatie\CollectionMacros\Macros\Extract::class,
            'fifth' => \Spatie\CollectionMacros\Macros\Fifth::class,
            'filterMap' => \Spatie\CollectionMacros\Macros\FilterMap::class,
            'firstOrFail' => \Spatie\CollectionMacros\Macros\FirstOrFail::class,
            'fourth' => \Spatie\CollectionMacros\Macros\Fourth::class,
            'fromPairs' => \Spatie\CollectionMacros\Macros\FromPairs::class,
            'glob' => \Spatie\CollectionMacros\Macros\Glob::class,
            'groupByModel' => \Spatie\CollectionMacros\Macros\GroupByModel::class,
            'head' => \Spatie\CollectionMacros\Macros\Head::class,
            'ifAny' => \Spatie\CollectionMacros\Macros\IfAny::class,
            'ifEmpty' => \Spatie\CollectionMacros\Macros\IfEmpty::class,
            'ninth' => \Spatie\CollectionMacros\Macros\Ninth::class,
            'none' => \Spatie\CollectionMacros\Macros\None::class,
            'paginate' => \Spatie\CollectionMacros\Macros\Paginate::class,
            'parallelMap' => \Spatie\CollectionMacros\Macros\ParallelMap::class,
            'pluckToArray' => \Spatie\CollectionMacros\Macros\PluckToArray::class,
            'prioritize' => \Spatie\CollectionMacros\Macros\Prioritize::class,
            'rotate' => \Spatie\CollectionMacros\Macros\Rotate::class,
            'second' => \Spatie\CollectionMacros\Macros\Second::class,
            'sectionBy' => \Spatie\CollectionMacros\Macros\SectionBy::class,
            'seventh' => \Spatie\CollectionMacros\Macros\Seventh::class,
            'simplePaginate' => \Spatie\CollectionMacros\Macros\SimplePaginate::class,
            'sixth' => \Spatie\CollectionMacros\Macros\Sixth::class,
            'sliceBefore' => \Spatie\CollectionMacros\Macros\SliceBefore::class,
            'tail' => \Spatie\CollectionMacros\Macros\Tail::class,
            'tenth' => \Spatie\CollectionMacros\Macros\Tenth::class,
            'third' => \Spatie\CollectionMacros\Macros\Third::class,
            'toPairs' => \Spatie\CollectionMacros\Macros\ToPairs::class,
            'transpose' => \Spatie\CollectionMacros\Macros\Transpose::class,
            'try' => \Spatie\CollectionMacros\Macros\TryCatch::class,
            'validate' => \Spatie\CollectionMacros\Macros\Validate::class,
            'withSize' => \Spatie\CollectionMacros\Macros\WithSize::class,
        ];
    }
}
