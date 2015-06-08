<?php

namespace Uthmordar\Cardator\Card\lib;

class LodgingReservation extends Reservation{
    protected $parents="Thing\Intangible\Reservation";
    protected $checkinTime;
    protected $checkoutTime;
    protected $lodgingUnitDescription;
    protected $lodgingUnitType;
    protected $numAdults;
    protected $numChildren;
    protected $type="http://schema.org/LodgingReservation";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('checkinTime', 'filterDateTime');
        $this->addFilter('checkoutTime', 'filterDateTime');
    }
}