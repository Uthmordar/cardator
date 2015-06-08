<?php

namespace Uthmordar\Cardator\Card\lib;

class PropertyValueSpecification extends Intangible{
    protected $parents="Thing\Intangible";
    protected $defaultValue;
    protected $maxValue;
    protected $minValue;
    protected $multipleValues;
    protected $readonlyValue;
    protected $stepValue;
    protected $valueMaxLength;
    protected $valueMinLength;
    protected $valueName;
    protected $valuePattern;
    protected $valueRequired;
    protected $type="http://schema.org/PropertyValueSpecification";
}