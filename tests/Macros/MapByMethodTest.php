<?php

declare(strict_types=1);

namespace Spatie\CollectionMacros\Test\Macros;

use PHPUnit\Framework\TestCase;
use Illuminate\Support\Collection;

class MapByMethodTest extends TestCase
{
    /** @var Collection */
    private $dudes;

    protected function setUp() : void
    {
        $this->dudes = collect([
            new FakeValueObject('Frank', 23),
            new FakeValueObject('Joe', 48),
        ]);
    }

    /** @test */
    public function it_should_add_map_by_method() : void
    {
        $ages = $this->dudes->mapByMethod('age')->all();

        $this->assertSame([23, 48], $ages);
    }

    /** @test */
    public function pluck_should_not_work_on_private_properties() : void
    {
        // This test proves the necessity of mapByMethod.
        $ages = $this->dudes->pluck('age')->all();

        $this->assertSame([null, null], $ages);
    }

    /** @test */
    public function map_by_method_should_support_arguments() : void
    {
        /** @var Collection $dudes */
        $dudes = $this->dudes->mapByMethod('growOlder', 5, 'years');

        $this->assertSame(28, $dudes->first()->age());
    }
}

class FakeValueObject
{
    /** @var string */
    private $name;
    /** @var int */
    private $age;

    public function __construct(string $name, int $age)
    {
        $this->name = $name;
        $this->age = $age;
    }

    public function name() : string
    {
        return $this->name;
    }

    public function age() : int
    {
        return $this->age;
    }

    public function growOlder(int $amount, string $unit) : self
    {
        $years = $unit === 'months' ? floor($amount / 12) : $amount;  // contrived example to test 2 arguments

        $this->age += $years;

        // When using mapByMethod we have to return the object on mutators, else we create a collection of nulls.
        return $this;
    }
}
