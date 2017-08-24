<?php

use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Collection;

/*
 * Paginate the given collection
 *
 * @param int $perPage
 * @param int $total
 * @param int $page
 * @param string $pageName
 *
 * @return \Illuminate\Pagination\LengthAwarePaginator
 */
Collection::macro('paginate', function (int $perPage = 15, string $pageName = 'page', int $page = null, int $total = null, array $options = []): LengthAwarePaginator {
    $page = $page ?: LengthAwarePaginator::resolveCurrentPage($pageName);

    $results = $this->forPage($page, $perPage);

    $total = $total ?: $this->count();

    $options += [
        'path' => LengthAwarePaginator::resolveCurrentPath(),
        'pageName' => $pageName,
    ];

    return new LengthAwarePaginator($results, $total, $perPage, $page, $options);
});
