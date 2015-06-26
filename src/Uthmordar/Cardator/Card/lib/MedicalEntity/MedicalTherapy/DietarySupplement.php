<?php

namespace Uthmordar\Cardator\Card\lib;

class DietarySupplement extends MedicalTherapy {

    protected $parents = "Thing\MedicalEntity\MedicalTherapy";
    protected $activeIngredient;
    protected $background;
    protected $dosageForm;
    protected $isProprietary;
    protected $legalStatus;
    protected $manufacturer;
    protected $maximumIntake;
    protected $mechanismOfAction;
    protected $nonProprietaryName;
    protected $recommendedIntake;
    protected $safetyConsideration;
    protected $targetPopulation;
    protected $type = "http://schema.org/DietarySupplement";

}
