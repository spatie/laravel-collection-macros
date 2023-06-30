<?php


use Illuminate\Support\Collection;

it('provides paginate macro', function () {
    expect(Collection::hasMacro('simplePaginate'))->toBeTrue();
});

it('returns relevant context information', function () {
    $p = (new Collection(['item1', 'item2', 'item3']))->simplePaginate(2, 'page', 2);

    expect($p->currentPage())->toEqual(2);
    expect($p->hasPages())->toBeTrue();
    expect($p->hasMorePages())->toBeFalse();
    expect($p->items())->toEqual([2 => 'item3']);
    $pageInfo = [
        'per_page' => 2,
        'current_page' => 2,
        'next_page_url' => null,
        'prev_page_url' => 'http://localhost?page=1',
        'first_page_url' => 'http://localhost?page=1',
        'from' => 3,
        'to' => 3,
        'data' => [2 => 'item3'],
        'path' => 'http://localhost',
    ];
    expect($p->toArray())->toEqual($pageInfo);
});

it('removes trailing slashes', function () {
    $p = (new Collection($array = ['item1', 'item2', 'item3']))->simplePaginate(
        2,
        'page',
        2,
        ['path' => 'http://website.com/test/']
    );
    expect($p->previousPageUrl())->toEqual('http://website.com/test?page=1');
});

it('generates urls without trailing slash', function () {
    $p = (new Collection($array = ['item1', 'item2', 'item3']))->simplePaginate(
        2,
        'page',
        2,
        ['path' => 'http://website.com/test']
    );
    expect($p->previousPageUrl())->toEqual('http://website.com/test?page=1');
});
