<?php

namespace Uthmordar\Cardator\Card\lib;

class DrugClass extends MedicalTherapy {

    protected $parents = "Thing\MedicalEntity\MedicalTherapy";
    protected $drug;
    protected $type = "http://schema.org/DrugClass";

}
