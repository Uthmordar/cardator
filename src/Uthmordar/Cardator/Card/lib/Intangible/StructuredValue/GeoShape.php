<?php

namespace Uthmordar\Cardator\Card\lib;

class GeoShape extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $box;
    protected $circle;
    protected $elevation;
    protected $line;
    protected $polygon;
    protected $type = "http://schema.org/GeoShape";

}
