<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Illuminate\Support\Str;
use Spatie\CollectionMacros\Test\TestCase;

class IfTest extends TestCase
{
    /** @test */
    public function it_will_return_the_right_branch()
    {
        $this->assertTrue(collect()->if(true, then: true, else: false));
        $this->assertFalse(collect()->if(false, then: true, else: false));
    }

    /**
     * @test
     *
     * @dataProvider sentences
     */
    public function it_will_pass_the_collection_to_the_branches(string $sentence, string $modifiedSentence)
    {
        $collection = collect([$sentence])
            ->if(
                fn(Collection $collection) => $collection->contains('this is the value'),
                then: fn(Collection $collection) => $collection->map(fn(string $item) => strtoupper($item)),
                else: fn(Collection $collection) => $collection->map(fn(string $item) => Str::kebab($item))
            );

        $this->assertEquals($modifiedSentence, $collection[0]);
    }

    public function sentences(): array
    {
        return [
            ['this is the value', 'THIS IS THE VALUE'],
            ['this is another value', 'this-is-another-value'],
        ];
    }

    /** @test */
    public function the_branches_are_optional()
    {
        $result =  collect(['this is a value'])
            ->if(
                false,
                then: fn(Collection $collection) => 'something',
            );

        $this->assertNull($result);
    }
}
