<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalEntity extends Thing {

    protected $parents = "Thing";
    protected $code;
    protected $guideline;
    protected $medicineSystem;
    protected $recognizingAuthority;
    protected $releveantSpecialty;
    protected $study;
    protected $type = "http://schema.org/MedicalEntity";

}
