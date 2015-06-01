<?php

namespace Uthmordar\Cardator\Card\lib;

class Review extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $itemReviewed;
    protected $reviewBody;
    protected $reviewRating;
    protected $type="http://schema.org/Review";
}