<?php

namespace Uthmordar\Cardator\Card\lib;

class DeliveryChargeSpecification extends PriceSpecification{
    protected $parents="Thing\Intangible\StructuredValue\PriceSpecification";
    protected $appliesToBeDeliveryMethod;
    protected $eligibleRegion;
    protected $ineligibleRegion;
    protected $type="http://schema.org/DeliveryChargeSpecification";
}