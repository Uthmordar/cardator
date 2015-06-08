<?php

namespace Uthmordar\Cardator\Card\lib;

class BusTrip extends Intangible{
    protected $parents="Thing\Intangible";
    protected $arrivalBusStop;
    protected $arrivalTime;
    protected $busName;
    protected $busNumber;
    protected $departureBusStop;
    protected $departureTime;
    protected $provider;
    protected $type="http://schema.org/BusTrip";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('arrivalTime', 'filterDateTime');
        $this->addFilter('departureTime', 'filterDateTime');
    }
}