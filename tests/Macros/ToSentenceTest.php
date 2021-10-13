<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class ToSentenceTest extends TestCase
{
    /** @test */
    public function it_provides_a_to_sentence_macro()
    {
        $this->assertTrue(Collection::hasMacro('toSentence'));
    }

    /** @test */
    public function it_can_create_a_sentence_from_empty_collection()
    {
        $data = new Collection();

        $this->assertEquals('', $data->toSentence());
    }

    /** @test */
    public function it_can_create_a_sentence_from_one_item()
    {
        $data = new Collection(['foo']);

        $this->assertEquals('foo', $data->toSentence());
    }

    /** @test */
    public function it_can_create_a_sentence_from_two_items()
    {
        $data = new Collection(['foo', 'bar']);

        $this->assertEquals('foo & bar', $data->toSentence());
    }

    /** @test */
    public function it_can_create_a_sentence_from_many_items()
    {
        $data = new Collection(['foo', 'bar', 'baz']);

        $this->assertEquals('foo, bar & baz', $data->toSentence());
    }

    /** @test */
    public function it_can_create_a_sentence_with_custom_joiners()
    {
        $data = new Collection(['foo', 'bar', 'baz']);

        $this->assertEquals('foo, and bar and baz', $data->toSentence(', and ', ' and '));
    }
}
