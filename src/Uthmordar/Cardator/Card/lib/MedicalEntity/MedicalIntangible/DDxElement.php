<?php

namespace Uthmordar\Cardator\Card\lib;

class DDxElement extends MedicalIntangible{
    protected $parents="Thing\MedicalEntity\MedicalIntangible";
    protected $diagnosis;
    protected $distinguishingSign;
    protected $type="http://schema.org/DDxElement";
}