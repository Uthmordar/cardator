<?php

namespace Uthmordar\Cardator\Card\lib;

class FireStation extends CivicStructure{
    protected $parents="Thing\Place\CivicStructure::Thing\Organization\LocalBusiness";
    protected $currenciesAccepted;
    protected $openingHours;
    protected $parentOrganization;
    protected $paymentAccepted;
    protected $priceRange;
    protected $address;
    protected $aggregateRating;
    protected $award;
    protected $brand;
    protected $contactPoint;
    protected $department;
    protected $dissolutionDate;
    protected $duns;
    protected $email;
    protected $employee;
    protected $event;
    protected $faxNumber;
    protected $founder;
    protected $foundingDate;
    protected $foundingLocation;
    protected $globalLocationNumber;
    protected $hasPOS;
    protected $isicV4;
    protected $legalName;
    protected $location;
    protected $logo;
    protected $makesOffer;
    protected $member;
    protected $memberOf;
    protected $naics;
    protected $numberOfEmployees;
    protected $owns;
    protected $review;
    protected $seeks;
    protected $subOrganization;
    protected $taxID;
    protected $telephone;
    protected $vatID;
    protected $type="http://schema.org/FireStation";
}