<?php

namespace Uthmordar\Cardator\Card\lib;

class PriceSpecification extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $eligibleQuantity;
    protected $eligibleTransactionVolume;
    protected $maxPrice;
    protected $minPrice;
    protected $price;
    protected $priceCurrency;
    protected $validFrom;
    protected $validThrough;
    protected $valueAddedTaxIncluded;
    protected $type = "http://schema.org/PriceSpecification";

    public function __construct() {
        parent::__construct();
        $this->addFilter('validFrom', 'filterDateTime');
        $this->addFilter('validThrough', 'filterDateTime');
    }

}
