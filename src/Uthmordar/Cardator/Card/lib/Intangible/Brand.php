<?php

namespace Uthmordar\Cardator\Card\lib;

class Brand extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $aggregateRating;
    protected $logo;
    protected $review;
    protected $type = "http://schema.org/Brand";

}
