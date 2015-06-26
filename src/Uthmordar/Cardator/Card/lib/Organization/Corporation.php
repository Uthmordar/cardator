<?php

namespace Uthmordar\Cardator\Card\lib;

class Corporation extends Organization {

    protected $parents = "Thing\Organization";
    protected $tickerSymbol;
    protected $type = "http://schema.org/Corporation";

}
