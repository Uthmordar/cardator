<?php

namespace Uthmordar\Cardator\Card\lib;

class MovieTheater extends CivicStructure {

    protected $parents = "Thing\Place\CivicStructure::Thing\Organization\LocalBusiness\EntertainmentBusiness";
    protected $screenCount;
    protected $currenciesAccepted;

    use TraitOrganization;

    protected $type = "http://schema.org/MovieTheater";

}
