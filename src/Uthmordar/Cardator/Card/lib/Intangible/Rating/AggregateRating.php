<?php

namespace Uthmordar\Cardator\Card\lib;

class AggregateRating extends Rating{
    protected $parents="Thing\Intangible\Rating";
    protected $itemReviewed;
    protected $ratingCount;
    protected $reviewCount;
    protected $type="http://schema.org/AggregateRating";
}