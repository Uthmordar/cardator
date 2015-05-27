<?php

namespace Uthmordar\Cardator\Card\lib;

class BroadcastService extends Thing{
    protected $parents="Thing";
    protected $broadcastAffiliateOf;
    protected $name;
    protected $timezone;
    protected $broadcaster;
    protected $parentService;
    protected $type="http://schema.org/BroadcastService";
}