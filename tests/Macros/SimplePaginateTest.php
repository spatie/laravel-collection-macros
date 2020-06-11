<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\IntegrationTestCase;

class SimplePaginateTest extends IntegrationTestCase
{
    /** @test */
    public function it_provides_paginate_macro()
    {
        $this->assertTrue(Collection::hasMacro('simplePaginate'));
    }

    /** @test */
    public function it_returns_relevant_context_information()
    {
        $p = (new Collection(['item1', 'item2', 'item3']))->simplePaginate(2, 'page', 2);

        $this->assertEquals(2, $p->currentPage());
        $this->assertTrue($p->hasPages());
        $this->assertFalse($p->hasMorePages());
        $this->assertEquals([2 => 'item3'], $p->items());
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
        $this->assertEquals($pageInfo, $p->toArray());
    }

    /** @test */
    public function it_removes_trailing_slashes()
    {
        $p = (new Collection($array = ['item1', 'item2', 'item3']))->simplePaginate(
            2,
            'page',
            2,
            ['path' => 'http://website.com/test/']
        );
        $this->assertEquals('http://website.com/test?page=1', $p->previousPageUrl());
    }

    /** @test */
    public function it_generates_urls_without_trailing_slash()
    {
        $p = (new Collection($array = ['item1', 'item2', 'item3']))->simplePaginate(
            2,
            'page',
            2,
            ['path' => 'http://website.com/test']
        );
        $this->assertEquals('http://website.com/test?page=1', $p->previousPageUrl());
    }
}
