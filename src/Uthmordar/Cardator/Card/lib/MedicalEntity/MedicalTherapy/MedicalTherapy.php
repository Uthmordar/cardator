<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalTherapy extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $adverseOutcome;
    protected $contraindication;
    protected $duplicateTherapy;
    protected $indication;
    protected $seriousAdverseOutcome;
    protected $type = "http://schema.org/MedicalTherapy";

}
