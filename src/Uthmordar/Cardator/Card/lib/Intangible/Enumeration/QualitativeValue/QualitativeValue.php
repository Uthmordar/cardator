<?php

namespace Uthmordar\Cardator\Card\lib;

class QualitativeValue extends Enumeration{
    protected $parents="Thing\Intangible\Enumeration";
    protected $additionalProperty;
    protected $equal;
    protected $greater;
    protected $greaterOrEqual;
    protected $lesser;
    protected $lesserOrEqual;
    protected $nonEqual;
    protected $valueReference;
    protected $type="http://schema.org/QualitativeValue";
}