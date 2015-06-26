<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalEnumeration extends MedicalIntangible {

    protected $parents = "Thing\MedicalEntity\MedicalIntangible";
    protected $supersededBy;
    protected $type = "http://schema.org/MedicalEnumeration";

}
