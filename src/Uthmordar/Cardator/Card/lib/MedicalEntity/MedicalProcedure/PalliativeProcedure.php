<?php

namespace Uthmordar\Cardator\Card\lib;

class PalliativeProcedure extends MedicalProcedure {

    protected $parents = "Thing\MedicalEntity\MedicalProcedure::Thing\MedicalEntity\MedicalTherapy";
    protected $adverseOutcome;
    protected $contraindication;
    protected $duplicateTherapy;
    protected $indication;
    protected $seriousAdverseOutcome;
    protected $type = "http://schema.org/PalliativeProcedure";

}
