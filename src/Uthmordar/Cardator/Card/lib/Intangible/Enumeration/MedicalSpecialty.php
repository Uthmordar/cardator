<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalSpecialty extends Enumeration{
    protected $parents="Thing\Intangible\Enumeration";
    protected $code;
    protected $guideline;
    protected $medicineSystem;
    protected $recognizingAuthority;
    protected $relevantSpecialty;
    protected $type="http://schema.org/MedicalSpecialty";
}