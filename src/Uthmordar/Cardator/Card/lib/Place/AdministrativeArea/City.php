<?php

namespace Uthmordar\Cardator\Card\lib;

class City extends AdministrativeArea{
    protected $parents="Thing\Place\AdministrativeArea";
    protected $type="http://schema.org/City";
}