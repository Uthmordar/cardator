<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalConditionStage extends MedicalIntangible {

    protected $parents = "Thing\MedicalEntity\MedicalIntangible";
    protected $stageAsNumber;
    protected $subStageSuffix;
    protected $type = "http://schema.org/MedicalConditionStage";

}
