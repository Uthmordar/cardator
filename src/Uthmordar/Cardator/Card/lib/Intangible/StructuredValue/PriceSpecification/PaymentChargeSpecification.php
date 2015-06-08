<?php

namespace Uthmordar\Cardator\Card\lib;

class PaymentChargeSpecification extends PriceSpecification{
    protected $parents="Thing\Intangible\StructuredValue\PriceSpecification";
    protected $appliesToBeDeliveryMethod;
    protected $appliesToPaymentMethod;
    protected $type="http://schema.org/PaymentChargeSpecification";
}