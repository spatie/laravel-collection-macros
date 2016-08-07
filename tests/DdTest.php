<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class DdTest extends TestCase
{
    /** @test */
    public function it_provides_a_dd_macro()
    {
        $this->assertTrue(Collection::hasMacro('dd'));
    }
}
