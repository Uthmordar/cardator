<?php

namespace Uthmordar\Cardator\Card\lib;

class Offer extends Intangible{
    protected $parents="Thing\Intangible";
    protected $acceptedPaymentMethod;
    protected $addOn;
    protected $advanceBookingRequirement;
    protected $aggregateRating;
    protected $availability;
    protected $availabilityEnds;
    protected $availabilityStarts;
    protected $availabilityAtOrFrom;
    protected $availabilityDeliveryMethod;
    protected $businessFunction;
    protected $category;
    protected $deliveryLeadTime;
    protected $eligibleCustomerType;
    protected $eligibleDuration;
    protected $eligibleQuantity;
    protected $eligibleRegion;
    protected $eligibleTransactionVolume;
    protected $gtin12;
    protected $gtin13;
    protected $gtin14;
    protected $gtin8;
    protected $includesObject;
    protected $ineligibleRegion;
    protected $inventoryLevel;
    protected $itemCondition;
    protected $itemOffered;
    protected $mpn;
    protected $price;
    protected $priceCurrency;
    protected $priceSpecification;
    protected $priceValidUntil;
    protected $review;
    protected $seller;
    protected $serialNumber;
    protected $sku;
    protected $validFrom;
    protected $validThrough;
    protected $warranty;
    protected $type="http://schema.org/Offer";
    
    public function __construct(){
        parent::__construct();
        $this->addFilter('availabilityEnds', 'filterDateTime');
        $this->addFilter('availabilityStarts', 'filterDateTime');
        $this->addFilter('validFrom', 'filterDateTime');
        $this->addFilter('validThrough', 'filterDateTime');
    }
}