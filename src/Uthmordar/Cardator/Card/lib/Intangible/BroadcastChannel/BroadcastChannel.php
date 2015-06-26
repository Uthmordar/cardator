<?php

namespace Uthmordar\Cardator\Card\lib;

class BroadcastChannel extends Intangible {

    protected $parents = "Thing\Intangible";
    protected $broadcastChannelId;
    protected $broadcastServiceTier;
    protected $inBroadcastLineup;
    protected $providesBroadcastService;
    protected $type = "http://schema.org/BroadcastChannel";

}
