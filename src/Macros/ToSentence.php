<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Support\Collection;

/**
 * Transform a collection into a sentence.
 *
 * @param string $joiner
 * @param string $finalJoiner
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return string
 */
class ToSentence
{
    public function __invoke()
    {
        return function (string $joiner = ', ', string $finalJoiner = ' & '): string {
            switch ($this->count()) {
                case 0:
                    return '';
                case 1:
                    return $this->first();
                default:
                    $finalItem = $this->pop();

                    return $this->implode($joiner).$finalJoiner.$finalItem;
            };
        };
    }
}
