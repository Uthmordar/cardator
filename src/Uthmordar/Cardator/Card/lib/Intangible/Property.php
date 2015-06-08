<?php

namespace Uthmordar\Cardator\Card\lib;

class Property extends Intangible{
    protected $parents="Thing\Intangible";
    protected $domainIncludes;
    protected $inverseOf;
    protected $rangeIncludes;
    protected $supersededBy;
    protected $type="http://schema.org/Property";
}