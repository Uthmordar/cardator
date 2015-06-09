<?php

namespace Uthmordar\Cardator\Card\lib;

class Vein extends Vessel{
    protected $parents="Thing\MedicalEntity\AnatomicalStructure\Vessel";
    protected $drainsTo;
    protected $regionsDrained;
    protected $tributary;
    protected $type="http://schema.org/Vein";
}