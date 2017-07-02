<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class PaginateTest extends TestCase
{
    public function setUp()
    {
        $this->p = (new Collection(['item1', 'item2', 'item3', 'item4']))->paginate(2, 'page', 2, null);
    }

    /** @test */
    public function it_provides_paginate_macro()
    {
        $this->assertTrue(Collection::hasMacro('paginate'));
    }

    /** @test */
    public function it_gives_correct_total_number()
    {
        $this->assertEquals(4, $this->p->total());
    }

    /** @test */
    public function it_gets_and_sets_page_name()
    {
        $this->p = (new Collection(range(0, 22)))->paginate();
        $this->assertEquals('page', $this->p->getPageName());
        $this->p->setPageName('p');
        $this->assertEquals('p', $this->p->getPageName());
    }

    /** @test */
    public function it_can_generate_urls()
    {
        $this->p->setPath('http://website.com');
        $this->p->setPageName('foo');
        $this->assertEquals('http://website.com?foo=2',
            $this->p->url($this->p->currentPage()));
        $this->assertEquals('http://website.com?foo=1',
            $this->p->url($this->p->currentPage() - 1));
        $this->assertEquals('http://website.com?foo=1',
            $this->p->url($this->p->currentPage() - 2));
    }

    public function it_can_generate_urls_with_query()
    {
        $this->p->setPath('http://website.com?sort_by=date');
        $this->p->setPageName('foo');
        $this->assertEquals('http://website.com?sort_by=date&foo=2',
            $this->p->url($this->p->currentPage()));
    }

    public function it_can_generate_urls_without_trailing_slashes()
    {
        $this->p->setPath('http://website.com/test');
        $this->p->setPageName('foo');
        $this->assertEquals('http://website.com/test?foo=2',
            $this->p->url($this->p->currentPage()));
        $this->assertEquals('http://website.com/test?foo=1',
            $this->p->url($this->p->currentPage() - 1));
        $this->assertEquals('http://website.com/test?foo=1',
            $this->p->url($this->p->currentPage() - 2));
    }
}