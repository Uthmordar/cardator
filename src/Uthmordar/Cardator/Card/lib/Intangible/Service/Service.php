<?php

namespace Uthmordar\Cardator\Card\lib;

class Service extends Intangible{
    protected $parents="Thing\Intangible";
    protected $aggregateRating;
    protected $availableChannel;
    protected $provider;
    protected $review;
    protected $serviceArea;
    protected $serviceOutput;
    protected $serviceType;
    protected $type="http://schema.org/Service";
}