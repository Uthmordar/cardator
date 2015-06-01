<?php

namespace Uthmordar\Cardator\Card\lib;

class CreativeWorkSeries extends CreativeWork{
    protected $parents="Thing\CreativeWork";
    protected $endDate;
    protected $startDate;
    protected $type="http://schema.org/CreativeWorkSeries";
}