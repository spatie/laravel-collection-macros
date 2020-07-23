<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class AccumulateTest extends TestCase
{
    /** @test */
    public function it_provides_an_accumulate_macro()
    {
        $this->assertTrue(Collection::hasMacro('accumulate'));
    }

    /** @test */
    public function it_can_accumulate_values()
    {
        $data = new Collection([1, 2, 3, 4, 5]);

        $this->assertEquals([1, 3, 6, 10, 15], $data->accumulate()->toArray());
    }

    /** @test */
    public function it_can_accumulate_with_callback()
    {
        $data = new Collection([1, 2, 3, 4, 5]);

        $result = $data->accumulate(function ($value) {
            return $value * 2;
        });

        $this->assertEquals([2, 6, 12, 20, 30], $result->toArray());
    }

    /** @test */
    public function it_can_accumulate_with_key()
    {
        $data = new Collection([
            ['sales' => 10],
            ['sales' => 20],
            ['sales' => 30],
        ]);

        $result = $data->accumulate('sales');

        $this->assertEquals([10, 30, 60], $result->toArray());
    }

    /** @test */
    public function it_can_accumulate_values_with_initial()
    {
        $data = new Collection([1, 2, 3, 4, 5]);

        $result = $data->accumulate(null, 1);

        $this->assertEquals([2, 4, 7, 11, 16], $result->toArray());
    }
}
