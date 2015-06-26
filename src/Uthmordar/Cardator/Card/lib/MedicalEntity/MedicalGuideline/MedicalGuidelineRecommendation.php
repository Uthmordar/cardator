<?php

namespace Uthmordar\Cardator\Card\lib;

class MedicalGuidelineRecommendation extends MedicalGuideline {

    protected $parents = "Thing\MedicalEntity\MedicalGuideline";
    protected $recommendationStrength;
    protected $type = "http://schema.org/MedicalGuidelineRecommendation";

}
