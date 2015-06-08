<?php

namespace Uthmordar\Cardator\Card\lib;

class ServiceChannel extends Intangible{
    protected $parents="Thing\Intangible";
    protected $availableLanguage;
    protected $processingTime;
    protected $providesService;
    protected $serviceLocation;
    protected $servicePhone;
    protected $servicePostalAddress;
    protected $serviceSmsNumber;
    protected $serviceUrl;
    protected $type="http://schema.org/ServiceChannel";
}