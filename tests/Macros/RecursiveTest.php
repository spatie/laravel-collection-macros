<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Test\TestCase;

class RecursiveTest extends TestCase
{
	/** @test */
	public function it_provides_a_recursive_macro()
	{
		$this->assertTrue(Collection::hasMacro('recursive'));
	}

	/** @test */
	public function it_can_transform_arrays_and_objects_recursive_into_an_collection()
	{
		$test_obj   = new \stdClass();
		$test_array = ['object_test' => $test_obj, 'a'];

		$test_collection = collect([
			'array_test'  => $test_array,
			'object_test' => $test_obj,
			'b'           => 1,
		]);

		$new_collection = $test_collection->recursive();

		$this->assertTrue($this->is_a_collection($new_collection));
		$this->assertTrue($this->is_a_collection($new_collection->get('array_test')));
		$this->assertTrue($this->is_a_collection($new_collection->get('object_test')));
		$this->assertTrue($this->is_a_collection($new_collection->get('array_test')->get('object_test')));
	}

	protected function is_a_collection($var)
	{
		if (is_a($var, 'Illuminate\Support\Collection')) {
			return true;
		}

		return false;
	}
}
