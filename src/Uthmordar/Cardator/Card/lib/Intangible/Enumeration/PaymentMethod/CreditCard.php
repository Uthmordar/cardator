<?php

namespace Uthmordar\Cardator\Card\lib;

class CreditCard extends PaymentMethod{
    protected $parents="Thing\Intangible\Enumeration\PaymentMethod";
    protected $type="http://schema.org/CreditCard";
}