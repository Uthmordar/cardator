<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalTest extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $affectedBy;
    protected $normalRange;
    protected $signDetected;
    protected $usedToDiagnose;
    protected $usesDevice;
    protected $type = "http://schema.org/MedicalTest";

}
