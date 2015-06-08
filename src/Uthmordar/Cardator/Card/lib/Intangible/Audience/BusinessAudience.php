<?php

namespace Uthmordar\Cardator\Card\lib;

class BusinessAudience extends Audience{
    protected $parents="Thing\Intangible\Audience";
    protected $numberOfEmployees;
    protected $yearlyRevenue;
    protected $yearsInOperation;
    protected $type="http://schema.org/BusinessAudience";
}