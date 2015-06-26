<?php

namespace Uthmordar\Cardator\Card\lib;

class Place extends Thing {

    protected $parents = "Thing";
    protected $address;
    protected $aggregateRating;
    protected $containedIn;
    protected $event;
    protected $faxNumber;
    protected $globalLocationNumber;
    protected $hasMap;
    protected $isicV4;
    protected $logo;
    protected $openingHours;
    protected $photo;
    protected $review;
    protected $telephone;
    protected $recordedIn;
    protected $type = "http://schema.org/Place";

}
