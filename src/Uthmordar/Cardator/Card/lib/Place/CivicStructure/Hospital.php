<?php

namespace Uthmordar\Cardator\Card\lib;

class Hospital extends CivicStructure {

    protected $parents = "Thing\Place\CivicStructure::Thing\Organization\LocalBusiness\EmergencyService::Thing\Organization\LocalBusiness\MedicalOrganization";
    protected $availableService;
    protected $medicalSpecialty;
    protected $currenciesAccepted;
    protected $openingHours;

    use TraitOrganization;

    protected $type = "http://schema.org/Hospital";

}
