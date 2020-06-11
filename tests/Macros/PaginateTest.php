<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class PaginateTest extends TestCase
{
    public function setup(): void
    {
        parent::setUp();

        $this->collectionPaginator = (new Collection(['item1', 'item2', 'item3', 'item4']))->paginate(2, 'page', 2, null);
    }

    /** @test */
    public function it_provides_paginate_macro()
    {
        $this->assertTrue(Collection::hasMacro('paginate'));
    }

    /** @test */
    public function it_gives_correct_total_number()
    {
        $this->assertEquals(4, $this->collectionPaginator->total());
    }

    /** @test */
    public function it_gets_and_sets_page_name()
    {
        $this->collectionPaginator = (new Collection(range(0, 22)))->paginate();
        $this->assertEquals('page', $this->collectionPaginator->getPageName());
        $this->collectionPaginator->setPageName('p');
        $this->assertEquals('p', $this->collectionPaginator->getPageName());
    }

    /** @test */
    public function it_can_generate_urls()
    {
        $this->collectionPaginator->setPath('http://website.com');
        $this->collectionPaginator->setPageName('foo');
        $this->assertEquals(
            'http://website.com?foo=2',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage())
        );
        $this->assertEquals(
            'http://website.com?foo=1',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 1)
        );
        $this->assertEquals(
            'http://website.com?foo=1',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 2)
        );
    }

    public function it_can_generate_urls_with_query()
    {
        $this->collectionPaginator->setPath('http://website.com?sort_by=date');
        $this->collectionPaginator->setPageName('foo');
        $this->assertEquals(
            'http://website.com?sort_by=date&foo=2',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage())
        );
    }

    public function it_can_generate_urls_without_trailing_slashes()
    {
        $this->collectionPaginator->setPath('http://website.com/test');
        $this->collectionPaginator->setPageName('foo');
        $this->assertEquals(
            'http://website.com/test?foo=2',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage())
        );
        $this->assertEquals(
            'http://website.com/test?foo=1',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 1)
        );
        $this->assertEquals(
            'http://website.com/test?foo=1',
            $this->collectionPaginator->url($this->collectionPaginator->currentPage() - 2)
        );
    }
}
