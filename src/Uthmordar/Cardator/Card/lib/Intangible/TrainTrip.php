<?php

namespace Uthmordar\Cardator\Card\lib;

class TrainTrip extends Intangible{
    protected $parents="Thing\Intangible";
    protected $arrivalPlatform;
    protected $arrivalStation;
    protected $arrivalTime;
    protected $departurePlatform;
    protected $departureStation;
    protected $departureTime;
    protected $provider;
    protected $trainName;
    protected $trainNumber;
    protected $type="http://schema.org/TrainTrip";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('arrivalTime', 'filterDateTime');
        $this->addFilter('departureTime', 'filterDateTime');
    }
}