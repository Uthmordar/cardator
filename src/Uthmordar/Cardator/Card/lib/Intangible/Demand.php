<?php

namespace Uthmordar\Cardator\Card\lib;

class Demand extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $acceptedPaymentMethod;
    protected $advanceBookingRequirement;
    protected $availability;
    protected $availabilityEnds;
    protected $availabiltityStarts;
    protected $availableAtOrFrom;
    protected $availableDeliveryMethod;
    protected $businessFunction;
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
    protected $priceSpecification;
    protected $seller;
    protected $serialNumber;
    protected $sku;
    protected $validFrom;
    protected $validThrough;
    protected $warranty;
    protected $type = "http://schema.org/Demand";

}
