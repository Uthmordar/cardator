<?php

namespace Uthmordar\Cardator\Card\lib;

class UnitPriceSpecification extends PriceSpecification{
    protected $parents="Thing\Intangible\StructuredValue\PriceSpecification";
    protected $billingIncrement;
    protected $priceType;
    protected $unitCode;
    protected $unitText;
    protected $type="http://schema.org/UnitPriceSpecification";
}