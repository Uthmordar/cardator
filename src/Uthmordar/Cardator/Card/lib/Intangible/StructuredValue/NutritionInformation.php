<?php

namespace Uthmordar\Cardator\Card\lib;

class NutritionInformation extends StructuredValue{
    protected $parents="Thing\Intangible\StructuredValue";
    protected $calories;
    protected $carbohydrateContent;
    protected $cholesterolContent;
    protected $fatContent;
    protected $fiberContent;
    protected $proteinContent;
    protected $saturatedFatContent;
    protected $servingSize;
    protected $sodiumContent;
    protected $sugarContent;
    protected $transFatContent;
    protected $unsaturatedFatContent;
    protected $type="http://schema.org/NutritionInformation";
}