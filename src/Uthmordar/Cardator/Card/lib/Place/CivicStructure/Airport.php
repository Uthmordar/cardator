<?php

namespace Uthmordar\Cardator\Card\lib;

class Airport extends CivicStructure {

    protected $parents = "Thing\Place\CivicStructure";
    protected $iataCode;
    protected $icaoCode;
    protected $type = "http://schema.org/Airport";

}
