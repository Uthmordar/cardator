<?php

namespace Uthmordar\Cardator\Card\lib;

class ReservationPackage extends Reservation{
    protected $parents="Thing\Intangible\Reservation";
    protected $subReservation;
    protected $type="http://schema.org/ReservationPackage";
}