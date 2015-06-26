<?php

namespace Uthmordar\Cardator\Card\lib;

class LymphaticVessel extends Vessel {

    protected $parents = "Thing\MedicalEntity\AnatomicalStructure\Vessel";
    protected $originatedFrom;
    protected $regionDrained;
    protected $runsTo;
    protected $type = "http://schema.org/LymphaticVessel";

}
