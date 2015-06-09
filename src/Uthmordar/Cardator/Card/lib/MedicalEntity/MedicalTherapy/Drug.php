<?php

namespace Uthmordar\Cardator\Card\lib;

class Drug extends MedicalTherapy{
    protected $parents="Thing\MedicalEntity\MedicalTherapy";
    protected $activeIngredient;
    protected $administrationRoute;
    protected $alcoholWarning;
    protected $availableStrength;
    protected $breastfeedingWarning;
    protected $clinicalPharmacology;
    protected $cost;
    protected $dosageForm;
    protected $doseSchedule;
    protected $drugClass;
    protected $foodWarning;
    protected $interactingDrug;
    protected $isAvailableGenerically;
    protected $isProprietary;
    protected $labelDetails;
    protected $legalStatus;
    protected $manufacturer;
    protected $mechanismOfAction;
    protected $nonProprietaryName;
    protected $overdosage;
    protected $pregnancyCategory;
    protected $pregnancyWarning;
    protected $prescribingInfo;
    protected $presciptionStatus;
    protected $relatedDrug;
    protected $warning;
    protected $type="http://schema.org/Drug";
}