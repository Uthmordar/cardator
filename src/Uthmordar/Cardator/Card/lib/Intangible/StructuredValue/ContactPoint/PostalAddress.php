<?php

namespace Uthmordar\Cardator\Card\lib;

class PostalAddress extends ContactPoint {

    protected $parents = "Thing\Intangible\StructuredValue\ContactPoint";
    protected $addressCountry;
    protected $addressLocality;
    protected $addressRegion;
    protected $postOfficeBoxNumber;
    protected $postalCode;
    protected $streetAddress;
    protected $type = "http://schema.org/PostalAddress";

}
