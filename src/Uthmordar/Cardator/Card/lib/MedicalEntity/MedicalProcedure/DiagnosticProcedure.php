<?php

namespace Uthmordar\Cardator\Card\lib;

class DiagnosticProcedure extends MedicalProcedure{
    protected $parents="Thing\MedicalEntity\MedicalProcedure::Thing\MedicalEntity\MedicalTest";
    protected $affectedBy;
    protected $normalRange;
    protected $signDetected;
    protected $usedToDiagnose;
    protected $usesDevice;
    protected $type="http://schema.org/DiagnosticProcedure";
}