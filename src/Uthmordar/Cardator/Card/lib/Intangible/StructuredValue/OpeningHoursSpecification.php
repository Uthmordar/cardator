<?php

namespace Uthmordar\Cardator\Card\lib;

class OpeningHoursSpecification extends StructuredValue{
    protected $parents="Thing\Intangible\StructuredValue";
    protected $closes;
    protected $dayOfWeek;
    protected $opens;
    protected $validFrom;
    protected $validThrough;
    protected $type="http://schema.org/OpeningHoursSpecification";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('validFrom', 'filterDateTime');
        $this->addFilter('validThrough', 'filterDateTime');
    }
}