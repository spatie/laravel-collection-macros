<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class AfterTest extends TestCase
{
    /** @test */
    public function testAfter()
    {
        $data = new Collection([1, 2, 3]);

        $result = $data->after(7);
        $this->assertEquals(null, $result);

        $result = $data->after(3, $data->first());
        $this->assertEquals(1, $result);

        $result = $data->after(1);
        $this->assertEquals(2, $result);
    }

    public function testAfterOrder()
    {
        $data = new Collection([3 => 3, 2 => 1, 1 => 2]);

        $result = $data->after(3);
        $this->assertEquals(1, $result);
    }

    public function testAfterStringKey()
    {
        $data = new Collection(['foo' => 'bar', 'bar' => 'foo']);

        $result = $data->after('bar');
        $this->assertEquals('foo', $result);
    }

    public function testAfterCallback()
    {
        $data = new Collection([3, 1, 2]);

        $result = $data->after(function ($item) {
            return $item > 2;
        });
        $this->assertEquals(1, $result);

        $result = $data->after(function ($item) {
            return $item > 3;
        });
        $this->assertEquals(null, $result);

        $result = $data->after(function ($item) {
            return $item > 3;
        }, 6);
        $this->assertEquals(6, $result);
    }
}
