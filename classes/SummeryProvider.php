<?php


namespace common\modules\summery\classes;

class SummeryProvider
{
    public $array;

    protected $array_data;

    public function __construct(?array $array)
    {

    }

    public function getArray() {
        return $this->array;
    }


    public function __call($name, $arguments)
    {
        echo "Вызов метода '$name' "
            . implode(', ', $arguments). "\n";
    }


}