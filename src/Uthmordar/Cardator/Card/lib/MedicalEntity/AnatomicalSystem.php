<?php

namespace Uthmordar\Cardator\Card\lib;

class AnatomicalSystem extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $associatedPathophysiology;
    protected $comprisedOf;
    protected $relatedCondition;
    protected $relatedStructure;
    protected $relatedTherapy;
    protected $type = "http://schema.org/AnatomicalSystem";

}
