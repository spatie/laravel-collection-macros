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
            'after' => \Spatie\CollectionMacros\Macros\After::class,
            'at' => \Spatie\CollectionMacros\Macros\At::class,
            'before' => \Spatie\CollectionMacros\Macros\Before::class,
            'chunkBy' => \Spatie\CollectionMacros\Macros\ChunkBy::class,
            'collectBy' => \Spatie\CollectionMacros\Macros\CollectBy::class,
            'containsAll' => \Spatie\CollectionMacros\Macros\ContainsAll::class,
            'containsAny' => \Spatie\CollectionMacros\Macros\ContainsAny::class,
            'eachCons' => \Spatie\CollectionMacros\Macros\EachCons::class,
            'eighth' => \Spatie\CollectionMacros\Macros\Eighth::class,
            'extract' => \Spatie\CollectionMacros\Macros\Extract::class,
            'fifth' => \Spatie\CollectionMacros\Macros\Fifth::class,
            'filterMap' => \Spatie\CollectionMacros\Macros\FilterMap::class,
            'firstOrFail' => \Spatie\CollectionMacros\Macros\FirstOrFail::class,
            'firstOrPush' => \Spatie\CollectionMacros\Macros\FirstOrPush::class,
            'fourth' => \Spatie\CollectionMacros\Macros\Fourth::class,
            'fromPairs' => \Spatie\CollectionMacros\Macros\FromPairs::class,
            'getCaseInsensitive' => \Spatie\CollectionMacros\Macros\GetCaseInsensitive::class,
            'getNth' => \Spatie\CollectionMacros\Macros\GetNth::class,
            'glob' => \Spatie\CollectionMacros\Macros\Glob::class,
            'groupByModel' => \Spatie\CollectionMacros\Macros\GroupByModel::class,
            'hasCaseInsensitive' => \Spatie\CollectionMacros\Macros\HasCaseInsensitive::class,
            'head' => \Spatie\CollectionMacros\Macros\Head::class,
            'if' => \Spatie\CollectionMacros\Macros\IfMacro::class,
            'ifAny' => \Spatie\CollectionMacros\Macros\IfAny::class,
            'ifEmpty' => \Spatie\CollectionMacros\Macros\IfEmpty::class,
            'insertAfter' => \Spatie\CollectionMacros\Macros\InsertAfter::class,
            'insertAfterKey' => \Spatie\CollectionMacros\Macros\InsertAfterKey::class,
            'insertAt' => \Spatie\CollectionMacros\Macros\InsertAt::class,
            'insertBefore' => \Spatie\CollectionMacros\Macros\InsertBefore::class,
            'insertBeforeKey' => \Spatie\CollectionMacros\Macros\InsertBeforeKey::class,
            'ninth' => \Spatie\CollectionMacros\Macros\Ninth::class,
            'none' => \Spatie\CollectionMacros\Macros\None::class,
            'paginate' => \Spatie\CollectionMacros\Macros\Paginate::class,
            'parallelMap' => \Spatie\CollectionMacros\Macros\ParallelMap::class,
            'path' => \Spatie\CollectionMacros\Macros\Path::class,
            'pluckMany' => \Spatie\CollectionMacros\Macros\PluckMany::class,
            'pluckManyValues' => \Spatie\CollectionMacros\Macros\PluckManyValues::class,
            'pluckToArray' => \Spatie\CollectionMacros\Macros\PluckToArray::class,
            'prioritize' => \Spatie\CollectionMacros\Macros\Prioritize::class,
            'recursive' => \Spatie\CollectionMacros\Macros\Recursive::class,
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
            'weightedRandom' => \Spatie\CollectionMacros\Macros\WeightedRandom::class,
            'withSize' => \Spatie\CollectionMacros\Macros\WithSize::class,
        ];
    }
}
