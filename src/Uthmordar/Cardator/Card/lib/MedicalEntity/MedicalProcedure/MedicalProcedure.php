<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalProcedure extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $followup;
    protected $howPerformed;
    protected $prepartion;
    protected $procedureType;
    protected $type = "http://schema.org/MedicalProcedure";

}
