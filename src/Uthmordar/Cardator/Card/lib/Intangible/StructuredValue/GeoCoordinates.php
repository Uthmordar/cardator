<?php

namespace Uthmordar\Cardator\Card\lib;

class GeoCoordinates extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $elevation;
    protected $latitude;
    protected $longitude;
    protected $type = "http://schema.org/GeoCoordinates";

}
