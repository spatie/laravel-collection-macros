<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class BeforeTest extends TestCase
{
    /** @test */
    public function testBefore()
    {
        $data = new Collection([1, 2, 3]);

        $result = $data->before(7);
        $this->assertEquals(null, $result);

        $result = $data->before(1, $data->last());
        $this->assertEquals(3, $result);

        $result = $data->before(2);
        $this->assertEquals(1, $result);
    }

    public function testBeforeOrder()
    {
        $data = new Collection([3 => 3, 2 => 1, 1 => 2]);

        $result = $data->before(1);
        $this->assertEquals(3, $result);
    }

    public function testBeforeStringKey()
    {
        $data = new Collection(['foo' => 'bar', 'bar' => 'foo']);

        $result = $data->before('foo');
        $this->assertEquals('bar', $result);
    }

    public function testBeforeCallback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->before(function ($item) {
            return $item < 2;
        });
        $this->assertEquals(3, $result);

        $result = $data->before(function ($item) {
            return $item > 2;
        });
        $this->assertEquals(null, $result);

        $result = $data->before(function ($item) {
            return $item > 3;
        }, 6);
        $this->assertEquals(6, $result);
    }
}
