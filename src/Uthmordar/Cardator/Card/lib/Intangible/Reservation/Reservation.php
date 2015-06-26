<?php

namespace Uthmordar\Cardator\Card\lib;

class Reservation extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $bookingTime;
    protected $broker;
    protected $modifiedTime;
    protected $priceCurrency;
    protected $programMembershipUsed;
    protected $provider;
    protected $reservationFor;
    protected $reservationId;
    protected $reservationStatus;
    protected $reservedTicket;
    protected $totalPrice;
    protected $underName;
    protected $type = "http://schema.org/Reservation";

    public function __construct() {
        parent::__construct();
        $this->addFilter('bookingTime', 'filterDateTime');
        $this->addFilter('modifiedTime', 'filterDateTime');
    }

}
