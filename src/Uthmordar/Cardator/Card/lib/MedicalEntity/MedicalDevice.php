<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalDevice extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $adverseOutcome;
    protected $contraindication;
    protected $indication;
    protected $postOp;
    protected $preOp;
    protected $procedure;
    protected $purpose;
    protected $seriousAdverseOutcome;
    protected $type = "http://schema.org/MedicalDevice";

}
