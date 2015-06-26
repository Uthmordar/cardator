<?php

namespace Uthmordar\Cardator\Card\lib;

class ContactPoint extends StructuredValue {

    protected $parents = "Thing\Intangible\StructuredValue";
    protected $areaServed;
    protected $availableLanguage;
    protected $contactOption;
    protected $email;
    protected $faxNumber;
    protected $hoursAvailable;
    protected $productSupported;
    protected $telephone;
    protected $type = "http://schema.org/ContactPoint";

}
