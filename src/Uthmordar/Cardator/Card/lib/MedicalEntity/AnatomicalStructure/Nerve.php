<?php

namespace Uthmordar\Cardator\Card\lib;

class Nerve extends AnatomicalStructure {

    protected $parents = "Thing\MedicalEntity\AnatomicalStructure";
    protected $branch;
    protected $nerveMotor;
    protected $sensoryUnit;
    protected $sourcedFrom;
    protected $type = "http://schema.org/Nerve";

}
