<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalRiskScore extends MedicalRiskEstimator{
    protected $parents="Thing\MedicalEntity\MedicalRiskEstimator";
    protected $algorithm;
    protected $type="http://schema.org/MedicalRiskScore";
}