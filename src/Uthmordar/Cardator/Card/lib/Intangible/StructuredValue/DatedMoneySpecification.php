<?php

namespace Uthmordar\Cardator\Card\lib;

class DatedMoneySpecification extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $amount;
    protected $currency;
    protected $endDate;
    protected $startDate;
    protected $type = "http://schema.org/DatedMoneySpecification";

}
