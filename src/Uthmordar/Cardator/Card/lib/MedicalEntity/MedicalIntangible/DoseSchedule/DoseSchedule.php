<?php

namespace Uthmordar\Cardator\Card\lib;

class DoseSchedule extends MedicalIntangible {

    protected $parents = "Thing\MedicalEntity\MedicalIntangible";
    protected $doseUnit;
    protected $doseValue;
    protected $frequency;
    protected $targetPopulation;
    protected $type = "http://schema.org/DoseSchedule";

}
