<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Foundation\Application;
use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class HasNotNullTest extends TestCase
{
    /** @test */
    public function it_can_check_if_a_key_exists_and_is_not_null()
    {
        $this->assertFalse(Collection::make(['foo'])->hasNotNull('foo'));
        $this->assertFalse(Collection::make(['foo' => null])->hasNotNull('foo'));
        $this->assertTrue(Collection::make(['foo' => 'bar'])->hasNotNull('foo'));
    }
}
