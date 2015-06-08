<?php

namespace Uthmordar\Cardator\Card\lib;

class Ticket extends Intangible{
    protected $parents="Thing\Intangible";
    protected $dateIssued;
    protected $issuedBy;
    protected $priceCurrency;
    protected $ticketNumber;
    protected $ticketToken;
    protected $ticketedSeat;
    protected $totalPrice;
    protected $underName;
    protected $type="http://schema.org/Ticket";
}