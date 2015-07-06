<?php

namespace Uthmordar\Cardator\Card\lib;

class PoliceStation extends CivicStructure {

    protected $parents = "Thing\Place\CivicStructure::Thing\Organization\LocalBusiness\EmergencyService";
    protected $currenciesAccepted;
    protected $openingHours;

    use TraitOrganization;

    protected $type = "http://schema.org/PoliceStation";

}
