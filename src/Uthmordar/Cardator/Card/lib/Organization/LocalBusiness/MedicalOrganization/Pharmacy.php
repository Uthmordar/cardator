<?php

namespace Uthmordar\Cardator\Card\lib;

class Pharmacy extends MedicalOrganization{
    protected $parents="Thing\Organization\LocalBusiness\MedicalOrganization";
    protected $type="http://schema.org/Pharmacy";
}