<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalCondition extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $associatedAnatomy;
    protected $cause;
    protected $differentialDiagnosis;
    protected $epidemiology;
    protected $expectedPrognosis;
    protected $naturalPrognosis;
    protected $pathophysiology;
    protected $possibleComplication;
    protected $possibleTreatment;
    protected $primaryPrevention;
    protected $riskFactor;
    protected $secondaryPrevention;
    protected $signOrSymptom;
    protected $stage;
    protected $subtype;
    protected $typicalTest;
    protected $type = "http://schema.org/MedicalCondition";

}
