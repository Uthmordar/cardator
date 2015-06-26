<?php

namespace Uthmordar\Cardator\Card\lib;

class DeliveryEvent extends Event {

    protected $parents = "Thing\Event";
    protected $accessCode;
    protected $availableForm;
    protected $availableThrough;
    protected $hasDeliveryMethod;
    protected $type = "http://schema.org/DeliveryEvent";

}
