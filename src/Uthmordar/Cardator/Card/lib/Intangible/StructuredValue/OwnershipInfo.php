<?php

namespace Uthmordar\Cardator\Card\lib;

class OwnershipInfo extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $acquiredFrom;
    protected $ownedFrom;
    protected $ownedThrough;
    protected $typeOfGood;
    protected $type = "http://schema.org/OwnershipInfo";

    public function __construct() {
        parent::__construct();
        $this->addFilter('ownedFrom', 'filterDateTime');
        $this->addFilter('ownedThrough', 'filterDateTime');
    }

}
