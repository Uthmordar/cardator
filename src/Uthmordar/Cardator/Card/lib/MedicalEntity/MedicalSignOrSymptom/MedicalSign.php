<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalSign extends MedicalSignOrSymptom{
    protected $parents="Thing\MedicalEntity\MedicalSignOrSymptom";
    protected $identifyingExam;
    protected $identifyingTest;
    protected $type="http://schema.org/MedicalSign";
}