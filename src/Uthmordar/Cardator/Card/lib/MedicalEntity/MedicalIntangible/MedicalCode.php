<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalCode extends MedicalIntangible {

    protected $parents = "Thing\MedicalEntity\MedicalIntangible";
    protected $codeValue;
    protected $codingSystem;
    protected $type = "http://schema.org/MedicalCode";

}
