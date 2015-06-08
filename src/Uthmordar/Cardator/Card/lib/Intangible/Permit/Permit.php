<?php

namespace Uthmordar\Cardator\Card\lib;

class Permit extends Intangible{
    protected $parents="Thing\Intangible";
    protected $issuedBy;
    protected $issuedThrough;
    protected $permitAudience;
    protected $validFor;
    protected $validFrom;
    protected $validIn;
    protected $validUntil;
    protected $type="http://schema.org/Permit";
}