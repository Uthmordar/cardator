<?php

namespace Uthmordar\Cardator\Card\lib;

class FoodEstablishmentReservation extends Reservation {

    protected $parents = "Thing\Intangible\Reservation";
    protected $endTime;
    protected $partySize;
    protected $startTime;
    protected $type = "http://schema.org/FoodEstablishmentReservation";

    public function __construct() {
        parent::__construct();
        $this->addFilter('endTime', 'filterDateTime');
        $this->addFilter('startTime', 'filterDateTime');
    }

}
