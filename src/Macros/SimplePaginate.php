<?php

namespace Spatie\CollectionMacros\Macros;

use Illuminate\Pagination\Paginator;

/**
 * Paginate the collection into a simple paginator.
 *
 * @param int $perPage
 * @param int $page
 * @param string $pageName
 *
 * @mixin \Illuminate\Support\Collection
 *
 * @return \Illuminate\Contracts\Pagination\Paginator
 */
class SimplePaginate
{
    public function __invoke()
    {
        return function (int $perPage = 15, string $pageName = 'page', int $page = null, array $options = []): Paginator {
            $page = $page ?: Paginator::resolveCurrentPage($pageName);

            $results = $this->slice(($page - 1) * $perPage)->take($perPage + 1);

            $options += [
                'path' => Paginator::resolveCurrentPath(),
                'pageName' => $pageName,
            ];

            return new Paginator($results, $perPage, $page, $options);
        };
    }
}
