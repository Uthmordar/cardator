<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalGuideline extends MedicalEntity {

    protected $parents = "Thing\MedicalEntity";
    protected $evidenceLevel;
    protected $evidenceOrigin;
    protected $guidelineDate;
    protected $guidelineSubject;
    protected $type = "http://schema.org/MedicalGuideline";

}
