<?php

namespace Uthmordar\Cardator\Card\lib;

class Country extends AdministrativeArea {

    protected $parents = "Thing\Place\AdministrativeArea";
    protected $type = "http://schema.org/Country";

}
