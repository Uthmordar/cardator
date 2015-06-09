<?php

namespace Uthmordar\Cardator\Card\lib;

class DrugLegalStatus extends MedicalIntangible{
    protected $parents="Thing\MedicalEntity\MedicalIntangible";
    protected $applicableLocation;
    protected $type="http://schema.org/DrugLegalStatus";
}