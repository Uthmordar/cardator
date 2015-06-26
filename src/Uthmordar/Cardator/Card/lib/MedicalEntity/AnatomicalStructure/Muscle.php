<?php

namespace Uthmordar\Cardator\Card\lib;

class Muscle extends AnatomicalStructure {

    protected $parents = "Thing\MedicalEntity\AnatomicalStructure";
    protected $antagonist;
    protected $bloodSupply;
    protected $insertion;
    protected $muscleAction;
    protected $nerve;
    protected $origin;
    protected $type = "http://schema.org/Muscle";

}
