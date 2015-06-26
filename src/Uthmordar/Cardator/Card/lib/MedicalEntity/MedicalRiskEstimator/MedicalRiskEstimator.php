<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalRiskEstimator extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $estimatesRiskOf;
    protected $includedRiskFactor;
    protected $type = "http://schema.org/MedicalRiskEstimator";

}
