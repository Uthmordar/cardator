<?php

namespace Uthmordar\Cardator\Card\lib;

class Physician extends MedicalOrganization {

    protected $parents = "Thing\Organization\LocalBusiness\MedicalOrganization";
    protected $type = "http://schema.org/Physician";

}
