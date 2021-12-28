<?php

namespace Spatie\CollectionMacros\Test\Macros;

use Illuminate\Support\Collection;
use Spatie\CollectionMacros\Exceptions\CollectionItemNotSetable;
use Spatie\CollectionMacros\Test\Fixtures\ConcreteModel;
use Spatie\CollectionMacros\Test\TestCase;

class SetTest extends TestCase
{
    /** @test */
    public function it_can_set_values_recursively_in_dot_notation()
    {
        $data = new Collection(['user' => ['name' => 'taylor', 'email' => 'foo']]);
        $data = $data->set('user.name', 'dayle');
        $this->assertEquals(['user' => ['name' => 'dayle', 'email' => 'foo']], $data->all());
    }

    /** @test */
    public function it_can_set_values_recursively_in_dot_notation_with_models()
    {
        $user1 = new ConcreteModel();
        $user1->user = [
            'name' => 'taylor',
            'email' => 'foo'
        ];

        $data = new Collection(['test' => $user1]);
        $data = $data->set('test.user.name', 'dayle');

        $this->assertEquals(['test' => [
            'user' => [
                'name' => 'dayle',
                'email' => 'foo'
            ]
        ]], $data->toArray());
    }

    /** @test */
    public function it_can_set_values_recursively_in_dot_notation_on_model_relationships()
    {
        $address = new ConcreteModel();
        $address->street = 'testlane';

        $user = new ConcreteModel();
        $user->name = 'taylor';
        $user->email = 'foo';
        $user->address = $address;

        $data = new Collection(['user1' => $user]);
        $data = $data->set('user1.address.street', 'changed lane');

        $changedAddress = new ConcreteModel();
        $changedAddress->street = 'changed lane';

        $this->assertEquals([
            'user1' => [
                'name' => 'taylor',
                'email' => 'foo',
                'address' => $changedAddress,
            ]
        ], $data->toArray());
    }

    /** @test */
    public function it_can_set_values_recursively_in_dot_notation_with_std_class()
    {
        $user1 = new \StdClass();
        $user1->user = [
            'name' => 'taylor',
            'email' => 'foo'
        ];

        $data = new Collection(['test' => $user1]);
        $data = $data->set('test.user.name', 'dayle');

        $stdClass = clone $user1;
        $stdClass->user['name'] = 'dayle';

        $this->assertEquals(['test' => $stdClass], $data->toArray());
    }

    /** @test */
    public function it_can_set_values_recursively_in_dot_notation_with_class_object()
    {
        $user1 = new Class(user: [
            'name' => 'taylor',
            'email' => 'foo'
        ]) {
            public function __construct(public $user)
            {
            }
        };

        $data = new Collection(['test' => $user1]);
        $data = $data->set('test.user.name', 'dayle');

        $classObject = clone $user1;
        $classObject->user['name'] = 'dayle';

        $this->assertEquals(['test' => $classObject], $data->toArray());
    }
}
