<?php

use Illuminate\Support\Collection;

uses(Spatie\CollectionMacros\Test\TestCase::class);

beforeEach(
    function () {
        $this->collectionPaginator = (new Collection(['item1', 'item2', 'item3', 'item4']))->paginate(2, 'page', 2, null);
    }
);

it('provides `paginate` macro')
    ->expect(fn () => Collection::hasMacro('paginate'))
    ->toBeTrue();

it('gives correct total number')
    ->expect(fn () => $this->collectionPaginator->total())
    ->toEqual(4);

it('gets and sets page name', function () {
    $this->collectionPaginator = (new Collection(range(0, 22)))->paginate();

    expect($this->collectionPaginator->getPageName())->toEqual('page');

    $this->collectionPaginator->setPageName('p');

    expect($this->collectionPaginator->getPageName())->toEqual('p');
});

it('can generate urls', function () {
    $this->collectionPaginator->setPath('http://website.com');
    $this->collectionPaginator->setPageName('foo');

    expect(
        $this->collectionPaginator->url($this->collectionPaginator->currentPage())
    )->toEqual('http://website.com?foo=2');

    expect([
        $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 1),
        $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 2)
    ])->each->toEqual('http://website.com?foo=1');
});

it('can generate urls with query', function () {
    $this->collectionPaginator->setPath('http://website.com?sort_by=date');
    $this->collectionPaginator->setPageName('foo');

    expect(
        $this->collectionPaginator->url($this->collectionPaginator->currentPage())
    )->toEqual('http://website.com?sort_by=date&foo=2');
});

it('can generate urls without trailing slashes', function () {
    $this->collectionPaginator->setPath('http://website.com/test');
    $this->collectionPaginator->setPageName('foo');

    expect(
        $this->collectionPaginator->url($this->collectionPaginator->currentPage())
    )->toEqual('http://website.com/test?foo=2');

    expect([
        $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 1),
        $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 2)
    ])->each->toEqual('http://website.com/test?foo=1');
});
