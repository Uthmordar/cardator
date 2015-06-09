<?php

namespace Uthmordar\Cardator\Card\lib;

class DrugCost extends MedicalIntangible{
    protected $parents="Thing\MedicalEntity\MedicalIntangible";
    protected $applicableLocation;
    protected $costCategory;
    protected $costCurrency;
    protected $costOrigin;
    protected $costPerUnit;
    protected $drugUnit;
    protected $type="http://schema.org/DrugCost";
}