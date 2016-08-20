<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class DumpTest extends TestCase
{
    /** @test */
    public function it_provides_a_dump_macro()
    {
        $this->assertTrue(Collection::hasMacro('dump'));
    }
}
