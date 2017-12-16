<?php

namespace Spatie\CollectionMacros\Test;

use Illuminate\Support\Collection;
use Symfony\Component\Stopwatch\Stopwatch;

class ParallelMapTest extends TestCase
{
    /** Symfony\Component\Stopwatch\Stopwatch */
    protected $stopWatch;

    public function setUp()
    {
        parent::setUp();

        $this->stopWatch = new Stopwatch();
    }

    /** @test */
    public function it_can_perform_async_map_operations()
    {
        $this->startStopWatch();

        $collection = Collection::make([1, 2, 3])->parallelMap(function (int $number) {
            sleep($number);

            return $number * 10;
        });

        $this->assertTookLessThenSeconds(4);

        $this->assertEquals([10, 20, 30], $collection->toArray());
    }

    protected function startStopWatch()
    {
        $this->stopWatch->start('test');
    }

    protected function assertTookLessThenSeconds(int $seconds)
    {
        $durationInMilliseconds = $this->stopWatch->stop('test')->getDuration();

        $this->assertLessThan($seconds * 1000, $durationInMilliseconds);
    }
}
