<?php

namespace Uthmordar\Cardator\Card\lib;

class FlightReservation extends Reservation {

    protected $parents = "Thing\Intangible\Reservation";
    protected $boardingGroup;
    protected $passengerPriorityStatus;
    protected $passengerSequenceNumber;
    protected $securityScreening;
    protected $type = "http://schema.org/FlightReservation";

}
