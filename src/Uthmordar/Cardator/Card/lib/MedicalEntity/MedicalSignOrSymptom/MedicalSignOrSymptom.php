<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalSignOrSymptom extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $cause;
    protected $possibleTreatment;
    protected $type = "http://schema.org/MedicalSignOrSymptom";

}
