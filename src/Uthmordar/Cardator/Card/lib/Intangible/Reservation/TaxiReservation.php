<?php

namespace Uthmordar\Cardator\Card\lib;

class TaxiReservation extends Reservation {

    protected $parents = "Thing\Intangible\Reservation";
    protected $partySize;
    protected $pickupLocation;
    protected $pickupTime;
    protected $type = "http://schema.org/TaxiReservation";

    public function __construct() {
        parent::__construct();
        $this->addFilter('pickupTime', 'filterDateTime');
    }

}
