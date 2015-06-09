<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalObservationalStudy extends MedicalStudy{
    protected $parents="Thing\MedicalEntity\MedicalStudy";
    protected $studyDesign;
    protected $type="http://schema.org/MedicalObservationalStudy";
}