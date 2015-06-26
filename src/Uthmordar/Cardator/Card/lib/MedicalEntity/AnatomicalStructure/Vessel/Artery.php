<?php

namespace Uthmordar\Cardator\Card\lib;

class Artery extends Vessel {

    protected $parents = "Thing\MedicalEntity\AnatomicalStructure\Vessel";
    protected $arterialBranch;
    protected $source;
    protected $supplyTo;
    protected $type = "http://schema.org/Artery";

}
