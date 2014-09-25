<?php

class RetrievableTraitTest extends PHPUnit_Framework_TestCase
{

    public $stub;
    public $name = 'one';
    public $data = ['data' => 'params'];
    public $param_1 = 5;
    public $param_2 = true;
    public $param_3 = 3.14;
    public function setup()
    {
        if (is_null($this->stub))
        {
            if (! class_exists('RetrievableTraitStub')) {
                require __DIR__ . '/RetrievableTraitStub.php';
            }
            $this->stub  = new RetrievableTraitStub($this->name, $this->data, $this->param_1, $this->param_2, $this->param_3);
        }
    }
    public function test_it_should_retrieve_only_the_keys_provided()
    {
        $fields = $this->stub->retrieveOnly('name', 'data');
        $this->assertArrayHasKey('name', $fields);
        $this->assertArrayHasKey('data', $fields);
        $this->assertArrayNotHasKey('param_1', $fields);
        $this->assertArrayNotHasKey('param_2', $fields);
        $this->assertArrayNotHasKey('param_3', $fields);
        $this->assertEquals($this->name, $fields['name']);
        $this->assertEquals($this->data, $fields['data']);
    }
    public function test_it_should_not_retrieve_the_keys_provided()
    {
        $fields = $this->stub->retrieveExcept('param_1', 'param_2', 'param_3');
        $this->assertArrayHasKey('name', $fields);
        $this->assertArrayHasKey('data', $fields);
        $this->assertArrayNotHasKey('param_1', $fields);
        $this->assertArrayNotHasKey('param_2', $fields);
        $this->assertArrayNotHasKey('param_3', $fields);
        $this->assertEquals($this->name, $fields['name']);
        $this->assertEquals($this->data, $fields['data']);
    }
}