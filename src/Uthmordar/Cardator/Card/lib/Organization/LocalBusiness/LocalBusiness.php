<?php

namespace Uthmordar\Cardator\Card\lib;

class LocalBusiness extends Organization {

    protected $parents = "Thing\Organization::Thing\Place";
    protected $currenciesAccepted;
    protected $openingHours;
    protected $parentOrganization;
    protected $paymentAccepted;
    protected $priceRange;
    protected $additionalProperty;
    protected $address;
    protected $aggregateRating;
    protected $containedIn;
    protected $event;
    protected $faxNumber;
    protected $geo;
    protected $globalLocationNumber;
    protected $hasMap;
    protected $isicV4;
    protected $logo;
    protected $openingHoursSpecificaiton;
    protected $photo;
    protected $review;
    protected $telephone;
    protected $type = "http://schema.org/LocalBusiness";

}
