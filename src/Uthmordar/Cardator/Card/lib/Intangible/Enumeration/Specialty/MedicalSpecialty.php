<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalSpecialty extends Specialty {

    protected $parents = "Thing\Intangible\Enumeration\Specialty";
    protected $code;
    protected $guideline;
    protected $medicineSystem;
    protected $recognizingAuthority;
    protected $relevantSpecialty;
    protected $study;
    protected $type = "http://schema.org/MedicalSpecialty";

}
