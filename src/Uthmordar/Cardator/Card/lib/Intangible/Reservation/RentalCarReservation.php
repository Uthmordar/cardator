<?php

namespace Uthmordar\Cardator\Card\lib;

class RentalCarReservation extends Reservation{
    protected $parents="Thing\Intangible\Reservation";
    protected $dropoffLocation;
    protected $dropoffTime;
    protected $pickupLocation;
    protected $pickupTime;
    protected $type="http://schema.org/RentalCarReservation";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('dropoffTime', 'filterDateTime');
        $this->addFilter('pickupTime', 'filterDateTime');
    }
}