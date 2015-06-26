<?php

namespace Uthmordar\Cardator\Card\lib;

class SuperficialAnatomy extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $associatedPathophysiology;
    protected $relatedAnatomy;
    protected $relatedCondition;
    protected $relatedTherapy;
    protected $significance;
    protected $type = "http://schema.org/SuperficialAnatomy";

}
