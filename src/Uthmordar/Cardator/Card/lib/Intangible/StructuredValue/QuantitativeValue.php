<?php

namespace Uthmordar\Cardator\Card\lib;

class QuantitativeValue extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $additionalProperty;
    protected $maxValue;
    protected $minValue;
    protected $unitCode;
    protected $unitText;
    protected $value;
    protected $valueReference;
    protected $type = "http://schema.org/QuantitativeValue";

}
