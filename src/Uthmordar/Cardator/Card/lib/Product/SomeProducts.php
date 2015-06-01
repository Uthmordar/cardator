<?php

namespace Uthmordar\Cardator\Card\lib;

class SomeProducts extends Product{
    protected $parents="Thing\Product";
    protected $inventoryLevel;
    protected $type="http://schema.org/SomeProducts";
}