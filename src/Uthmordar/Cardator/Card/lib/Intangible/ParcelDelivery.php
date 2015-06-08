<?php

namespace Uthmordar\Cardator\Card\lib;

class ParcelDelivery extends Intangible{
    protected $parents="Thing\Intangible";
    protected $deliveryAddress;
    protected $deliveryStatus;
    protected $expectedArrivalFrom;
    protected $expectedArrivalUntil;
    protected $hasDeliveryMethod;
    protected $itemShipped;
    protected $originAddress;
    protected $partOfOrder;
    protected $provider;
    protected $trackingNumber;
    protected $trackingUrl;
    protected $type="http://schema.org/ParcelDelivery";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('expectedArrivalFrom', 'filterDateTime');
        $this->addFilter('expectedArrivalUntil', 'filterDateTime');
    }
}