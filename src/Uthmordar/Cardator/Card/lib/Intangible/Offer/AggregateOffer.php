<?php

namespace Uthmordar\Cardator\Card\lib;

class AggregateOffer extends Offer{
    protected $parents="Thing\Intangible\Offer";
    protected $highPrice;
    protected $lowPrice;
    protected $offerCount;
    protected $offers;
    protected $type="http://schema.org/AggregateOffer";
}