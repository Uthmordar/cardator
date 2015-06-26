<?php

namespace Uthmordar\Cardator\Card\lib;

class TypeAndQuantityNode extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $amountOfThisGood;
    protected $businessFunction;
    protected $typeOfGood;
    protected $unitCode;
    protected $unitText;
    protected $type = "http://schema.org/TypeAndQuantityNode";

}
