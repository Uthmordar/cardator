<?php

namespace Uthmordar\Cardator\Card\lib;

class OnDemandEvent extends PublicationEvent{
    protected $parents="Thing\Event\PublicationEvent";
    protected $type="http://schema.org/OnDemandEvent";
}