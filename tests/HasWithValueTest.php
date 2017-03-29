<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;

class HasWithValueTest extends TestCase
{
    /** @test */
    function can_tell_if_key_exists_in_collection_and_has_a_value()
    {
        $data = new Collection([
            'string' => 'foo',
            'integer' => 0,
            'decimal' => 0.0,
            'zero' => '0',
            'true' => true,
            'false' => false,
            'function' => function () {
            },
            'array' => [
                'test',
            ],
            'nested' => [
                'array' => [
                    'string' => 'foo',
                ],
            ],
        ]);

        $this->assertTrue($data->hasWithValue('string'));
        $this->assertTrue($data->hasWithValue('integer'));
        $this->assertTrue($data->hasWithValue('decimal'));
        $this->assertTrue($data->hasWithValue('function'));
        $this->assertTrue($data->hasWithValue('zero'));
        $this->assertTrue($data->hasWithValue('true'));
        $this->assertTrue($data->hasWithValue('false'));
        $this->assertTrue($data->hasWithValue('array'));
        $this->assertTrue($data->hasWithValue('nested'));
        $this->assertTrue($data->hasWithValue('nested.array'));
        $this->assertTrue($data->hasWithValue('nested.array.string'));
    }

    /** @test */
    function can_tell_if_key_does_not_exists_in_collection_or_has_no_value()
    {
        $data = new Collection([
            'null' => null,
            'string' => '',
            'array' => [],
            'nested' => [
                'null' => null,
            ],
        ]);

        $this->assertFalse($data->hasWithValue('null'));
        $this->assertFalse($data->hasWithValue('string'));
        $this->assertFalse($data->hasWithValue('array'));
        $this->assertFalse($data->hasWithValue('nested.null'));
    }
}
