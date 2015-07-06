<?php

namespace Uthmordar\Cardator\Card\lib;

class StadiumOrArena extends CivicStructure {

    protected $parents = "Thing\Place\CivicStructure::Thing\Organization\LocalBusiness\SportsActivityLocation";
    protected $currenciesAccepted;
    protected $openingHours;

    use TraitOrganization;

    protected $type = "http://schema.org/StadiumOrArena";

}
