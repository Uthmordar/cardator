<?php

namespace Uthmordar\Cardator\Card\lib;

class Joint extends AnatomicalStructure{
    protected $parents="Thing\MedicalEntity\AnatomicalStructure";
    protected $biomechnicalClass;
    protected $functionalClass;
    protected $structuralClass;
    protected $type="http://schema.org/Joint";
}