<?php

namespace Uthmordar\Cardator\Card\lib;

class Audience extends Intangible{
    protected $parents="Thing\Intangible";
    protected $audienceType;
    protected $geographicArea;
    protected $type="http://schema.org/Audience";
}