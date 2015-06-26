<?php

namespace Uthmordar\Cardator\Card\lib;

class BroadcastEvent extends PublicationEvent {

    protected $parents = "Thing\Event\PublicationEvent";
    protected $isLiveBroadcast;
    protected $type = "http://schema.org/BroadcastEvent";

}
