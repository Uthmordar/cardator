<?php

namespace Uthmordar\Cardator\Card\lib;

class Dentist extends MedicalOrganization{
    protected $parents="Thing\Organization\LocalBusiness\MedicalOrganization::Thing\Organization\LocalBusiness\ProfessionalService";
    protected $type="http://schema.org/Dentist";
}