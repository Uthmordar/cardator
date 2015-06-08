<?php

namespace Uthmordar\Cardator\Card\lib;

class WarrantyPromise extends StructuredValue{
    protected $parents="Thing\Intangible\StructuredValue";
    protected $durationOfWarranty;
    protected $warrantyScope;
    protected $type="http://schema.org/WarrantyPromise";
}