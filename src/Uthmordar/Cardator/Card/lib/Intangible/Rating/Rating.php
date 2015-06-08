<?php

namespace Uthmordar\Cardator\Card\lib;

class Rating extends Intangible{
    protected $parents="Thing\Intangible";
    protected $bestRating;
    protected $ratingValue;
    protected $worstRating;
    protected $type="http://schema.org/Rating";
}