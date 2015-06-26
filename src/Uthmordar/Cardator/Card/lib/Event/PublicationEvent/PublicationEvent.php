<?php

namespace Uthmordar\Cardator\Card\lib;

class PublicationEvent extends Event {

    protected $parents = "Thing\Event";
    protected $isAccessibleForFree;
    protected $publishedOn;
    protected $type = "http://schema.org/PublicationEvent";

}
