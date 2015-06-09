<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalTrial extends MedicalStudy{
    protected $parents="Thing\MedicalEntity\MedicalStudy";
    protected $phase;
    protected $trialDesign;
    protected $type="http://schema.org/MedicalTrial";
}