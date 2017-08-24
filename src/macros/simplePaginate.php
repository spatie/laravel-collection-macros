<?php

use Illuminate\Support\Collection;
use Illuminate\Pagination\Paginator;

/*
 * Paginate the collection into a simple paginator
 *
 * @param int $perPage
 * @param int $page
 * @param string $pageName
 *
 * @return \Illuminate\Contracts\Pagination\Paginator
 */
Collection::macro('simplePaginate', function (int $perPage = 15, string $pageName = 'page', int $page = null, array $options = []): Paginator {
    $page = $page ?: Paginator::resolveCurrentPage($pageName);

    $results = $this->slice(($page - 1) * $perPage)->take($perPage + 1);

    $options += [
        'path' => Paginator::resolveCurrentPath(),
        'pageName' => $pageName,
    ];

    return new Paginator($results, $perPage, $page, $options);
});
