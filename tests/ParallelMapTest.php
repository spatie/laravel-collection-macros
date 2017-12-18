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

        $collection = Collection::make([1, 2, 3, 4, 5])->parallelMap(function (int $number) {
            sleep(1);

            return $number * 10;
        });

        $this->assertTookLessThanSeconds(2);

        $this->assertEquals([10, 20, 30, 40, 50], $collection->toArray());
    }

    /** @test */
    public function it_can_handle_a_large_collection()
    {
        $elementCount = 1000;

        $newCollection = Collection::make(range(1, $elementCount))->parallelMap(function (int $number) {
            return $number * 2;
        });

        $this->assertCount($elementCount, $newCollection);

        $expectedNumber = 0;

        foreach ($newCollection as $newNumber) {
            $this->assertEquals($expectedNumber += 2, $newNumber);
        }
    }

    /** @test */
    public function it_can_handle_large_responses()
    {
        $sources = Collection::make([
            'https://spatie.be/en',
            'https://spatie.be/en/opensource',
            'https://laravel.com',
        ])->parallelMap(function (string $url) {
            return file_get_contents($url);
        });

        foreach ($sources as $source) {
            $this->assertContains('</html>', $source);
        }
    }

    protected function startStopWatch()
    {
        $this->stopWatch->start('test');
    }

    protected function assertTookLessThanSeconds(int $seconds)
    {
        $durationInMilliseconds = $this->stopWatch->stop('test')->getDuration();

        $this->assertLessThan($seconds * 1000, $durationInMilliseconds);
    }
}
