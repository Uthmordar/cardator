<?php

namespace Uthmordar\Cardator\Card\lib;

class Flight extends Intangible{
    protected $parents="Thing\Intangible";
    protected $aircraft;
    protected $arrivalAirport;
    protected $arrivalGate;
    protected $arrivalTerminal;
    protected $arrivalTime;
    protected $boardingPolicy;
    protected $departureAirport;
    protected $departureGate;
    protected $departureTerminal;
    protected $departureTime;
    protected $estimatedFlightDuration;
    protected $flightDistance;
    protected $flightNumber;
    protected $mealService;
    protected $provider;
    protected $seller;
    protected $webCheckinTime;
    protected $type="http://schema.org/Flight";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('arrivalTime', 'filterDateTime');
        $this->addFilter('departureTime', 'filterDateTime');
    }
}