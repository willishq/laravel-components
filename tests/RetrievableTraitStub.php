<?php


use Willishq\LaravelComponents\RetrievableTrait;

class RetrievableTraitStub
{
    use RetrievableTrait;

    public $name;
    public $data;
    public $param_1;
    public $param_2;
    public $param_3;

    public function __construct($name, $data, $param_1, $param_2, $param_3)
    {
        $this->name = $name;
        $this->data = $data;
        $this->param_1 = $param_1;
        $this->param_2 = $param_2;
        $this->param_3 = $param_3;
    }
}