<?php

namespace Uthmordar\Cardator\Card\lib;

class ProductModel extends Product {

    protected $parents = "Thing\Product";
    protected $isVariantOf;
    protected $predecessorOf;
    protected $successorOf;
    protected $type = "http://schema.org/ProductModel";

}
