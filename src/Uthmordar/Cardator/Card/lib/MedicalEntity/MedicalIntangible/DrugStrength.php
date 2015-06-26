<?php

namespace Uthmordar\Cardator\Card\lib;

class DrugStrength extends MedicalIntangible {

    protected $parents = "Thing\MedicalEntity\MedicalIntangible";
    protected $activeIngredient;
    protected $available;
    protected $strengthUnit;
    protected $strengthValue;
    protected $type = "http://schema.org/DrugStrength";

}
