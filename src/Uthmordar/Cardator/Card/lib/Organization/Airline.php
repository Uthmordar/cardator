<?php

namespace Uthmordar\Cardator\Card\lib;

class Airline extends Organization{
    protected $parents="Thing\Organization";
    protected $boardingPolicy;
    protected $iataCode;
    protected $type="http://schema.org/Airline";
}