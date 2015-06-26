<?php

namespace Uthmordar\Cardator\Card\lib;

class IndividualProduct extends Product {

    protected $parents = "Thing\Product";
    protected $serialNumber;
    protected $type = "http://schema.org/IndividualProduct";

}
