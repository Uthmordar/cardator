<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalSymptom extends MedicalSignOrSymptom {

    protected $parents = "Thing\MedicalEntity\MedicalSignOrSymptom";
    protected $type = "http://schema.org/MedicalSymptom";

}
