<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalRiskFactor extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $increasesRiskOf;
    protected $type = "http://schema.org/MedicalRiskFactor";

}
