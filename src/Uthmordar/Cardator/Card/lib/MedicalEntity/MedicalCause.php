<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalCause extends MedicalEntity{
    protected $parents="Thing\MedicalEntity";
    protected $causeOf;
    protected $type="http://schema.org/MedicalCause";
}