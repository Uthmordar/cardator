<?php

namespace Uthmordar\Cardator\Card\lib;

class PropertyValue extends StructuredValue{
    protected $parents="Thing\Intangible\StructuredValue";
    protected $maxValue;
    protected $minValue;
    protected $propertyID;
    protected $unitCode;
    protected $unitText;
    protected $value;
    protected $valueReference;
    protected $type="http://schema.org/PropertyValue";
}